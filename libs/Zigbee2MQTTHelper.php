<?php

declare(strict_types=1);

namespace Zigbee2MQTT;

trait Zigbee2MQTTHelper
{
    private $stateTypeMapping = [
        // Gehört zu RequestAction
        // Hier werden die Fälle behandelt, wo standard-Aktionen nicht funktionieren.
        // boolean zu string, wenn ausser true und false andere Werte gesendet werden.
        // numeric werden speziell formatiert, wenn ein spezielles Format gewünscht wird.
        'Z2M_ChildLock'                         => ['type' => 'lockunlock', 'dataType' =>'string'],
        'Z2M_StateWindow'                       => ['type' => 'openclose', 'dataType' =>'string'],
        'Z2M_AutoLock'                          => ['type' => 'automode', 'dataType' => 'string'],
        'Z2M_ValveState'                        => ['type' => 'valve', 'dataType' => 'string'],
        'Z2M_EcoTemperature'                    => ['type' => 'numeric', 'dataType' => 'float', 'format' => '%.2f'],
        'Z2M_MaxTemperature'                    => ['type' => 'numeric', 'dataType' => 'float', 'format' => '%.2f'],
        'Z2M_MinTemperature'                    => ['type' => 'numeric', 'dataType' => 'float', 'format' => '%.2f'],
        'Z2M_TemperatureMax'                    => ['type' => 'numeric', 'dataType' => 'float', 'format' => '%.2f'],
        'Z2M_TemperatureMin'                    => ['type' => 'numeric', 'dataType' => 'float', 'format' => '%.2f'],
        'Z2M_OccupiedHeatingSetpointScheduled'  => ['type' => 'numeric', 'dataType' => 'float', 'format' => '%.2f'],
        'Z2M_ComfortTemperature'                => ['type' => 'numeric', 'dataType' => 'float', 'format' => '%.2f'],
        'Z2M_LocalTemperatureCalibration'       => ['type' => 'numeric', 'dataType' => 'float', 'format' => '%.2f'],
        'Z2M_OpenWindowTemperature'             => ['type' => 'numeric', 'dataType' => 'float', 'format' => '%.2f'],
        'Z2M_HolidayTemperature'                => ['type' => 'numeric', 'dataType' => 'float', 'format' => '%.2f'],

    ];

    public function RequestAction($ident, $value)
    {
        // Behandle spezielle Fälle separat
        // Fälle, wie z.B. die ganzen Farben, wo nicht einfach nur das $value gesetzt werden kann
        switch ($ident) {
        case 'Z2M_ColorTempPresets':
            $this->SendDebug(__FUNCTION__ . ' ColorTempPresets', $value, 0);
            // Erstellen des Payloads für die Farbtemperatur
            $payload = json_encode(['color_temp' => $value], JSON_UNESCAPED_SLASHES);

            // Senden des Payloads
            $this->Z2MSet($payload);
            return;
        case 'Z2M_Color':
            $this->SendDebug(__FUNCTION__ . ' Color', $value, 0);
            $this->setColor($value, 'cie');
            return;
        case 'Z2M_ColorHS':
            $this->SendDebug(__FUNCTION__ . ' Color HS', $value, 0);
            $this->setColor($value, 'hs');
            return;
        case 'Z2M_ColorRGB':
            $this->SendDebug(__FUNCTION__ . ' :: Color RGB', $value, 0);
            $this->setColor($value, 'cie', 'color_rgb');
            return;
        case 'Z2M_ColorTempKelvin':
            $convertedValue = strval(intval(round(1000000 / $value, 0)));
            $payloadKey = $this->convertIdentToPayloadKey($ident);
            $payload = [$payloadKey => $convertedValue];
            $payloadJSON = json_encode($payload, JSON_UNESCAPED_SLASHES);
            $this->Z2MSet($payloadJSON);
            return;
        }
        // Generelle Logik für die meisten anderen Fälle
        // ermitteln des Variablen-Typs
        $variableID = $this->GetIDForIdent($ident);
        $variableInfo = IPS_GetVariable($variableID);
        $variableType = $variableInfo['VariableType'];

        // Wandelt den Ident zum passenden Expose um
        $payloadKey = $this->convertIdentToPayloadKey($ident);

        // konvertiert den Wert in ein für Z2MSet nutzbaren Wert
        // Keine Unterscheidung mehr in strval($value), $value (numerisch), etc. mehr notwendig
        $payload = [$payloadKey => $this->convertStateBasedOnMapping($ident, $value, $variableType)];

        // Erstellung des passenden Payloads und versand durch Z2MSet
        $payloadJSON = json_encode($payload, JSON_UNESCAPED_SLASHES);
        $this->Z2MSet($payloadJSON);
    }

    public function getDeviceInfo() // Unverändert
    {
        $this->symconExtensionCommand('getDevice', $this->ReadPropertyString('MQTTTopic'));
    }

    public function getGroupInfo() // Unverändert
    {
        $this->symconExtensionCommand('getGroup', $this->ReadPropertyString('MQTTTopic'));
    }

    public function ReceiveData($JSONString) // Unverändert
    {
        if (!empty($this->ReadPropertyString('MQTTTopic'))) {
            $Buffer = json_decode($JSONString, true);

            if (IPS_GetKernelDate() > 1670886000) {
                $Buffer['Payload'] = utf8_decode($Buffer['Payload']);
            }

            $this->SendDebug('MQTT Topic', $Buffer['Topic'], 0);
            $this->SendDebug('MQTT Payload', $Buffer['Payload'], 0);

            if (array_key_exists('Topic', $Buffer)) {
                if (fnmatch('*/availability', $Buffer['Topic'])) {
                    $this->RegisterVariableBoolean('Z2M_Status', $this->Translate('Status'), 'Z2M.DeviceStatus');
                    if ($Buffer['Payload'] == 'online') {
                        $this->SetValue('Z2M_Status', true);
                    } else {
                        $this->SetValue('Z2M_Status', false);
                    }
                }
            }

            $Payload = json_decode($Buffer['Payload'], true);
            if (fnmatch('symcon/' . $this->ReadPropertyString('MQTTBaseTopic') . '/' . $this->ReadPropertyString('MQTTTopic') . '/deviceInfo', $Buffer['Topic'])) {
                if (is_array($Payload['exposes'])) {
                    $this->mapExposesToVariables($Payload['exposes']);
                }
            }
            if (fnmatch('symcon/' . $this->ReadPropertyString('MQTTBaseTopic') . '/' . $this->ReadPropertyString('MQTTTopic') . '/groupInfo', $Buffer['Topic'])) {
                if (is_array($Payload)) {
                    $this->mapExposesToVariables($Payload);
                }
            }

            $payload = json_decode($Buffer['Payload'], true);
            foreach ($payload as $key => $value) {
                $ident = 'Z2M_' . implode('', array_map('ucfirst', explode('_', $key)));
                $variableID = @$this->GetIDForIdent($ident);

                if ($variableID !== false) {
                    $variableInfo = IPS_GetVariable($variableID);
                    $variableType = $variableInfo['VariableType'];
                    $translate = $this->convertKeyToReadableFormat($key);
                    // Prüfen, ob der aktuelle Schlüssel spezielle Behandlung erfordert
                    // Spezielle Behandlungen unabhängig vom Typ durchführen
                    $handled = false; // Flag, um zu markieren, ob eine spezielle Behandlung durchgeführt wurde
                    switch ($key) {
                        case 'update_available':
                            $this->RegisterVariableBoolean('Z2M_Update', $this->Translate('Update'), '');
                            $this->SetValue('Z2M_Update', $payload['update_available']);
                            $handled = true;
                            break;
                        case 'scene':
                            $this->LogMessage('Please contact module developer. Undefined variable: scene', KL_WARNING);
                            //$this->RegisterVariableString('Z2M_Scene', $this->Translate('Scene'), '');
                            //$this->SetValue('Z2M_Scene', $payload['scene']);
                            $handled = true;
                            break;

                        case 'voltage':
                            if ($payload['voltage'] > 400) { //Es gibt wahrscheinlich keine Zigbee Geräte mit über 400 Volt
                                $this->SetValue('Z2M_Voltage', $payload['voltage'] / 1000);
                            } else {
                                $this->SetValue('Z2M_Voltage', $payload['voltage']);
                            }
                            $handled = true;
                            break;
                        case 'action_rate':
                            $this->RegisterVariableInteger('Z2M_ActionRate', $this->Translate('Action Rate'), $ProfileName);
                            $this->EnableAction('Z2M_ActionRate');
                            $this->SetValue('Z2M_ActionRate', $payload['action_rate']);
                            $handled = true;
                            break;
                        case 'action_level':
                            $this->RegisterVariableInteger('Z2M_ActionLevel', $this->Translate('Action Level'), $ProfileName);
                            $this->EnableAction('Z2M_ActionLevel');
                            $this->SetValue('Z2M_ActionLevel', $payload['action_level']);
                            $handled = true;
                            break;
                        case 'action_transition_time':
                            $this->RegisterVariableInteger('Z2M_ActionTransitionTime', $this->Translate('Action Transition Time'), $ProfileName);
                            $this->EnableAction('Z2M_ActionTransitionTime');
                            $this->SetValue('Z2M_ActionTransitionTime', $payload['action_transition_time']);
                            $handled = true;
                            break;
                        case 'child_lock':
                            $this->handleStateChange('child_lock', 'Z2M_ChildLock', 'Child Lock', $payload, ['LOCK' => true, 'UNLOCK' => false]);
                            $handled = true;
                            break;
                        case 'color':
                            if (is_array($value)) {
                                if (isset($value['x']) && isset($value['y'])) {
                                    $this->SendDebug(__FUNCTION__ . ' Color', $value['x'], 0);
                                    $brightness = isset($value['brightness']) ? $value['brightness'] : 255;
                                    $RGBColor = ltrim($this->xyToHEX($value['x'], $value['y'], $brightness), '#');
                                    $this->SendDebug(__FUNCTION__ . ' Color RGB HEX', $RGBColor, 0);
                                    $this->SetValue($ident, hexdec($RGBColor));
                                } elseif (isset($value['hue']) && isset($value['saturation'])) {
                                    $RGBColor = ltrim($this->HSToRGB($value['hue'], $value['saturation'], 255), '#');
                                    $this->SendDebug(__FUNCTION__ . ' Color RGB HEX', $RGBColor, 0);
                                    $this->SetValue($ident, hexdec($RGBColor));
                                }
                            }
                            $handled = true;
                            break;
                        case 'color_rgb':
                            if (isset($payload['color_rgb']) && is_array($payload['color_rgb'])) {
                                $colorRgb = $payload['color_rgb'];
                                $this->SendDebug(__FUNCTION__ . ':: Color X', $colorRgb['x'], 0);
                                $this->SendDebug(__FUNCTION__ . ':: Color Y', $colorRgb['y'], 0);
                                // Bestimmen der Helligkeit, falls vorhanden
                                $brightnessRgb = isset($payload['brightness_rgb']) ? $payload['brightness_rgb'] : 255;
                                $RGBColor = ltrim($this->xyToHEX($colorRgb['x'], $colorRgb['y'], $brightnessRgb), '#');
                                $this->SendDebug(__FUNCTION__ . ' Color :: RGB HEX', $RGBColor, 0);
                                $this->SetValue('Z2M_ColorRGB', hexdec($RGBColor));
                            }
                            $handled = true;
                            break;
                        case 'color_temp_cct':
                            $this->SetValue('Z2M_ColorTempCCT', $payload['color_temp_cct']);
                            if ($payload['color_temp_cct'] > 0) {
                                $this->SetValue('Z2M_ColorTempCCTKelvin', 1000000 / $payload['color_temp_cct']); //Convert to Kelvin
                            }
                            $handled = true;
                            break;
                        case 'color_temp_rgb':
                            $this->SetValue('Z2M_ColorTempRGB', $payload['color_temp_rgb']);
                            if ($payload['color_temp_rgb'] > 0) {
                                $this->SetValue('Z2M_ColorTempRGBKelvin', 1000000 / $payload['color_temp_rgb']); //Convert to Kelvin
                            }
                            $handled = true;
                            break;
                        case 'color_temp':
                            $this->SetValue('Z2M_ColorTemp', $payload['color_temp']);
                            if ($payload['color_temp'] > 0) {
                                $this->SetValue('Z2M_ColorTempKelvin', 1000000 / $payload['color_temp']); //Convert to Kelvin
                            }
                            $handled = true;
                            break;
                        case 'brightness_rgb':
                            $this->EnableAction('Z2M_BrightnessRGB');
                            $this->SetValue('Z2M_BrightnessRGB', $payload['brightness_rgb']);
                            $handled = true;
                            break;
                        case 'color_temp_startup_rgb':
                            $this->SetValue('Z2M_ColorTempStartupRGB', $payload['color_temp_startup_rgb']);
                            $this->EnableAction('Z2M_ColorTempStartupRGB');
                            $handled = true;
                            break;
                        case 'color_temp_startup_cct':
                            $this->SetValue('Z2M_ColorTempStartupCCT', $payload['color_temp_startup_cct']);
                            $this->EnableAction('Z2M_ColorTempStartupCCT');
                            $handled = true;
                            break;
                        case 'color_temp_startup':
                            $this->SetValue('Z2M_ColorTempStartup', $payload['color_temp_startup']);
                            $this->EnableAction('Z2M_ColorTempStartup');
                            $handled = true;
                            break;
                        case 'state_rgb':
                            $this->handleStateChange('state_rgb', 'Z2M_StateRGB', 'State_rgb', $payload, );
                            $this->EnableAction('Z2M_StateRGB');
                            $handled = true;
                            break;
                        case 'state_cct':
                            $this->handleStateChange('state_cct', 'Z2M_StateCCT', 'State_cct', $payload);
                            $this->EnableAction('Z2M_StateCCT');
                            $handled = true;
                            break;
                        case 'last_seen':
                            $translate = $this->convertKeyToReadableFormat($key);
                            $this->RegisterVariableInteger('Z2M_LastSeen', $this->Translate($translate), '~UnixTimestamp');
                            $this->SetValue($ident, $value / 1000);
                            $handled = true;
                            break;
                        case 'smoke_alarm_state':
                            $translate = $this->convertKeyToReadableFormat($key);
                            $this->handleStateChange($key, $ident, $translate, $payload);
                            $handled = true;
                            break;
                    }

                    if (!$handled) {
                        // Allgemeine Typbehandlung, wenn keine spezielle Behandlung durchgeführt wurde
                        switch ($variableType) {
                            case 0: // Boolean
                                $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                                $this->SendDebug(__FUNCTION__, "Ident: $ident, Wert: $value, Typ: Boolean", 0);
                                break;
                            case 1: // Integer
                                $value = intval($value);
                                $this->SendDebug(__FUNCTION__, "Ident: $ident, Wert: $value, Typ: Integer", 0);
                                break;
                            case 2: // Float
                                $value = floatval($value);
                                $this->SendDebug(__FUNCTION__, "Ident: $ident, Wert: $value, Typ: Float", 0);
                                break;
                            case 3: // String
                                $this->SendDebug(__FUNCTION__, "Ident: $ident, Wert: " . json_encode($value) . ", Typ: String", 0);
                                if (is_array($value)) {
                                // Konvertiert das Array zu einem String
                                // $value = json_encode($value); // Für eine JSON-Darstellung
                                    $value = implode(', ', $value); // Für eine kommagetrennte Liste
                                } else {
                                    // Stellt sicher, dass der Wert ein String ist
                                    $value = strval($value);
                                }
                                break;
                        }

                        $this->SetValue($ident, $value);
                    }
                } else {
                    // Die Variable existiert nicht; hier könnte Logik zum Erstellen der Variable stehen
                    $this->SendDebug(__FUNCTION__, "Ident $ident nicht gefunden", 0);
                }
            }
        }
    }
    private function convertKeyToReadableFormat($key)
    {
        $this->SendDebug(__FUNCTION__, "Schlüssel: $key", 0);
        $translateParts = explode('_', $key); // Teilt den Schlüssel in Teile
        $translatedParts = array_map('ucfirst', $translateParts); // Kapitalisiert jeden Teil
        $translate = implode(' ', $translatedParts); // Fügt die Teile mit einem Leerzeichen zusammen
        return $translate;
    }

    private function convertKeyToIdent($key)
    {
        $identParts = explode('_', $key); // Teilt den Schlüssel an Unterstrichen
        $capitalizedParts = array_map('ucfirst', $identParts); // Kapitalisiert jeden Teil
        $ident = 'Z2M_' . implode('', $capitalizedParts); // Fügt die Teile mit einem Präfix zusammen
        $this->SendDebug(__FUNCTION__, "Ident: $ident", 0);
        return $ident;
    }

    public function setColorExt($color, string $mode, array $params = [], string $Z2MMode = 'color')
    {
        switch ($mode) {
            case 'cie':
                $this->SendDebug(__FUNCTION__, $color, 0);
                $this->SendDebug(__FUNCTION__, $mode, 0);
                $this->SendDebug(__FUNCTION__, json_encode($params, JSON_UNESCAPED_SLASHES), 0);
                $this->SendDebug(__FUNCTION__, $Z2MMode, 0);
                if (preg_match('/^#[a-f0-9]{6}$/i', strval($color))) {
                    $color = ltrim($color, '#');
                    $color = hexdec($color);
                }
                $RGB = $this->HexToRGB($color);
                $cie = $this->RGBToXy($RGB);
                if ($Z2MMode = 'color') {
                    $Payload['color'] = $cie;
                    $Payload['brightness'] = $cie['bri'];
                } elseif ($Z2MMode == 'color_rgb') {
                    $Payload['color_rgb'] = $cie;
                } else {
                    return;
                }

                foreach ($params as $key => $value) {
                    $Payload[$key] = $value;
                }

                $PayloadJSON = json_encode($Payload, JSON_UNESCAPED_SLASHES);
                $this->SendDebug(__FUNCTION__, $PayloadJSON, 0);
                $this->Z2MSet($PayloadJSON);
                break;
            default:
                $this->SendDebug('setColor', 'Invalid Mode ' . $mode, 0);
                break;
        }
    }

    public function Z2MSet($payload) // Unverändert
    {
        $Data['DataID'] = '{043EA491-0325-4ADD-8FC2-A30C8EEB4D3F}';
        $Data['PacketType'] = 3;
        $Data['QualityOfService'] = 0;
        $Data['Retain'] = false;
        $Data['Topic'] = $this->ReadPropertyString('MQTTBaseTopic') . '/' . $this->ReadPropertyString('MQTTTopic') . '/set';
        $Data['Payload'] = $payload;
        $DataJSON = json_encode($Data, JSON_UNESCAPED_SLASHES);
        $this->SendDebug(__FUNCTION__ . ' Topic', $Data['Topic'], 0);
        $this->SendDebug(__FUNCTION__ . ' Payload', $Data['Payload'], 0);
        $this->SendDataToParent($DataJSON);
    }

    protected function createVariableProfiles() // Unverändert
    {
        /**
         * if (!IPS_VariableProfileExists('Z2M.Sensitivity')) {
         * $Associations = [];
         * $Associations[] = [1, $this->Translate('Medium'), '', -1];
         * $Associations[] = [2, $this->Translate('Low'), '', -1];
         * $Associations[] = [3, $this->Translate('High'), '', -1];
         * $this->RegisterProfileIntegerEx('Z2M.Sensitivity', '', '', '', $Associations);
         * }
         */
        /**
         * if (!IPS_VariableProfileExists('Z2M.Intensity.254')) {
         * $this->RegisterProfileInteger('Z2M.Intensity.254', 'Intensity', '', '%', 0, 254, 1);
         * }
         */
        if (!IPS_VariableProfileExists('Z2M.RadarSensitivity')) {
            $this->RegisterProfileInteger('Z2M.RadarSensitivity', 'Intensity', '', '', 0, 10, 1);
        }

        /**
         * if (!IPS_VariableProfileExists('Z2M.ColorTemperatureKelvin')) {
         * $this->RegisterProfileInteger('Z2M.ColorTemperatureKelvin', 'Intensity', '', '', 2000, 6535, 1);
         * }
         */

        /**
         * if (!IPS_VariableProfileExists('Z2M.RadarScene')) {
         * $this->RegisterProfileStringEx('Z2M.RadarScene', 'Menu', '', '', [
         * ['default', $this->Translate('Default'), '', 0xFFFFFF],
         * ['area', $this->Translate('Area'), '', 0x0000FF],
         * ['toilet', $this->Translate('Toilet'), '', 0x0000FF],
         * ['bedroom', $this->Translate('Bedroom'), '', 0x0000FF],
         * ['parlour', $this->Translate('Parlour'), '', 0x0000FF],
         * ['office', $this->Translate('Office'), '', 0x0000FF],
         * ['hotel', $this->Translate('Hotel'), '', 0x0000FF]
         * ]);
         * }
         */
        /**
         * if (!IPS_VariableProfileExists('Z2M.SystemMode')) {
         * $Associations = [];
         * $Associations[] = [1, $this->Translate('Off'), '', -1];
         * $Associations[] = [2, $this->Translate('Auto'), '', -1];
         * $Associations[] = [3, $this->Translate('Heat'), '', -1];
         * $Associations[] = [4, $this->Translate('Cool'), '', -1];
         * $this->RegisterProfileIntegerEx('Z2M.SystemMode', '', '', '', $Associations);
         * }
         */
        /**
         * if (!IPS_VariableProfileExists('Z2M.PowerOutageMemory')) {
         * $Associations = [];
         * $Associations[] = [1, $this->Translate('Off'), '', -1];
         * $Associations[] = [2, $this->Translate('On'), '', -1];
         * $Associations[] = [3, $this->Translate('Restore'), '', -1];
         * $this->RegisterProfileIntegerEx('Z2M.PowerOutageMemory', '', '', '', $Associations);
         * }
         */

        /**
         * if (!IPS_VariableProfileExists('Z2M.ThermostatPreset')) {
         * $Associations = [];
         * $Associations[] = [1, $this->Translate('Manual'), '', -1];
         * $Associations[] = [2, $this->Translate('Boost'), '', -1];
         * $Associations[] = [3, $this->Translate('Complexes Program'), '', -1];
         * $Associations[] = [4, $this->Translate('Comfort'), '', -1];
         * $Associations[] = [5, $this->Translate('Eco'), '', -1];
         * $Associations[] = [6, $this->Translate('Heat'), '', -1];
         * $Associations[] = [7, $this->Translate('Schedule'), '', -1];
         * $Associations[] = [8, $this->Translate('Away'), '', -1];
         * $this->RegisterProfileIntegerEx('Z2M.ThermostatPreset', '', '', '', $Associations);
         * }
         */
        /**
         * if (!IPS_VariableProfileExists('Z2M.ColorTemperature')) {
         * IPS_CreateVariableProfile('Z2M.ColorTemperature', 1);
         * }
         * IPS_SetVariableProfileDigits('Z2M.ColorTemperature', 0);
         * IPS_SetVariableProfileIcon('Z2M.ColorTemperature', 'Bulb');
         * IPS_SetVariableProfileText('Z2M.ColorTemperature', '', ' Mired');
         * IPS_SetVariableProfileValues('Z2M.ColorTemperature', 50, 500, 1);
         */

        /**
         * if (!IPS_VariableProfileExists('Z2M.ConsumerConnected')) {
         * $this->RegisterProfileBooleanEx('Z2M.ConsumerConnected', 'Plug', '', '', [
         * [false, $this->Translate('not connected'),  '', 0xFF0000],
         * [true, $this->Translate('connected'),  '', 0x00FF00]
         * ]);
         * }
         */
        if (!IPS_VariableProfileExists('Z2M.DeviceStatus')) {
            $this->RegisterProfileBooleanEx('Z2M.DeviceStatus', 'Network', '', '', [
                [false, 'Offline',  '', 0xFF0000],
                [true, 'Online',  '', 0x00FF00]
            ]);
        }
        if (!IPS_VariableProfileExists('Z2M.ChargeState')) {
            $this->RegisterProfileBooleanEx('Z2M.ChargeState', 'Battery', '', '', [
                [false, 'Kein laden',  '', 0xFF0000],
                [true, 'wird geladen',  '', 0x00FF00]
            ]);
        }
        if (!IPS_VariableProfileExists('Z2M.AutoLock')) {
            $this->RegisterProfileBooleanEx('Z2M.AutoLock', 'Key', '', '', [
                [false, $this->Translate('Manual'),  '', 0xFF0000],
                [true, $this->Translate('Auto'),  '', 0x00FF00]
            ]);
        }
        if (!IPS_VariableProfileExists('Z2M.ValveState')) {
            $this->RegisterProfileBooleanEx('Z2M.ValveState', 'Radiator', '', '', [
                [false, $this->Translate('Valve Closed'),  '', 0xFF0000],
                [true, $this->Translate('Valve Open'),  '', 0x00FF00]
            ]);
        }
        if (!IPS_VariableProfileExists('Z2M.WindowOpenInternal')) {
            $Associations = [];
            $Associations[] = [0, $this->Translate('Quarantine'), '', -1];
            $Associations[] = [1, $this->Translate('Windows are closed'), '', -1];
            $Associations[] = [2, $this->Translate('Hold'), '', -1];
            $Associations[] = [3, $this->Translate('Open window detected'), '', -1];
            $Associations[] = [4, $this->Translate('In window open state from external but detected closed locally'), '', -1];
            $this->RegisterProfileIntegerEx('Z2M.WindowOpenInternal', '', '', '', $Associations);
        }
    }

    protected function SetValue($ident, $value) // Unverändert
    {
        if (@$this->GetIDForIdent($ident)) {
            $this->SendDebug('Info :: SetValue for ' . $ident, 'Value: ' . $value, 0);
            parent::SetValue($ident, $value);
        } else {
            $this->SendDebug('Error :: No Expose for Value', 'Ident: ' . $ident, 0);
        }
    }
    private function convertIdentToPayloadKey($ident) // Neu
    {
        // Gehört zu RequestAction
        // Wandelt den Ident zu einem gültigen Expose um
        $identWithoutPrefix = str_replace('Z2M_', '', $ident);
        $this->SendDebug('Info :: convertIdentToPayloadKey', 'Ident: '. $ident.'-> IdentWithoutPrefix: '. $identWithoutPrefix, 0);
        $payloadKey = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $identWithoutPrefix));
        $this->SendDebug('Info :: convertIdentToPayloadKey', 'Ident: '. $ident.'-> PayloadKey: '. $payloadKey, 0);
        return $payloadKey;
    }

    private function convertStateBasedOnMapping($key, $value, $variableType) // Neu
    {
        // Gehört zu RequestAction
        // Überprüfe zuerst das spezielle Mapping für den Schlüssel
        if (array_key_exists($key, $this->stateTypeMapping)) {
            $mapping = $this->stateTypeMapping[$key];
            $dataType = $mapping['dataType'] ?? 'string'; // Standard auf 'string', falls nicht definiert
            // Spezielle Konvertierung basierend auf dem Typ im Mapping
            if (isset($mapping['type'])) {
                return $this->convertState($value, $mapping['type']);
            }
            // Formatierung des Wertes basierend auf dem definierten Datentyp
            // Verhindert "cannot autoconvert"-Fehler
            switch ($dataType) {
                case 'string':
                    return strval($value);
                case 'float':
                    $format = $mapping['format'] ?? '%f';
                    return sprintf($format, $value);
                case 'numeric':
                    return $value; // Keine Umwandlung notwendig
                default:
                    return strval($value); // Standardfall: Konvertiere zu String
            }
        }
        // Direkte Behandlung für boolesche Werte, wenn kein spezielles Mapping vorhanden ist
        // Setzt true/false auf "ON"/"OFF"
        if ($variableType === 0) { // Boolean
            return $value ? 'ON' : 'OFF';
        }
        // Standardbehandlung für Werte ohne spezifisches Mapping
        return is_numeric($value) ? $value : strval($value);
    }

    private function convertState($value, $type) // Neu
    {
        // Gehört zu RequestAction
        // Erweiterte Zustandsmappings
        // Setzt ankommende Werte auf true/false zur Nutzung als boolean in Symcon
        $stateMappings = [
            'onoff'      => ['ON', 'OFF'],
            'openclose'  => ['OPEN', 'CLOSE'],
            'lockunlock' => ['LOCK', 'UNLOCK'],
            'automanual' => ['AUTO', 'MANUAL'],
            'valve'      => ['OPEN', 'CLOSED'],
        ];
        // Prüfe, ob der Zustandstyp in den Mappings vorhanden ist
        if (array_key_exists($type, $stateMappings)) {
            // Wähle den korrekten Wert basierend auf dem booleschen $value
            return $value ? $stateMappings[$type][0] : $stateMappings[$type][1];
        } else {
            // Fallback für nicht definierte Zustandstypen
            return $value ? 'true' : 'false';
        }
    }
    private function handleStateChange($payloadKey, $valueId, $debugTitle, $payload, $stateMapping = null)
    {
        // Gehört zu ReceiveData
        if (array_key_exists($payloadKey, $payload)) {
            $state = $payload[$payloadKey];
            if ($stateMapping === null) {
                $stateMapping = ['ON' => true, 'OFF' => false];
            }
            // Prüfung stateMapping
            if (array_key_exists($state, $stateMapping)) {
                $this->SetValue($valueId, $stateMapping[$state]);
            } else {
                $this->SendDebug($debugTitle, 'Undefined State: ' . $state, 0);
            }
        }
    }

    private function setColor(int $color, string $mode, string $Z2MMode = 'color') // Unverändert
    {
        switch ($mode) {
            case 'cie':
                $RGB = $this->HexToRGB($color);
                $cie = $this->RGBToXy($RGB);
                if ($Z2MMode = 'color') {
                    $Payload['color'] = $cie;
                    $Payload['brightness'] = $cie['bri'];
                } elseif ($Z2MMode == 'color_rgb') {
                    $Payload['color_rgb'] = $cie;
                } else {
                    return;
                }
                $PayloadJSON = json_encode($Payload, JSON_UNESCAPED_SLASHES);
                $this->Z2MSet($PayloadJSON);
                break;
            case 'hs':
                $this->SendDebug('setColor - Input Color', json_encode($color), 0);
                if (!is_array($color)) {
                    $RGB = $this->HexToRGB($color);
                    $HSB = $this->RGBToHSB($RGB[0], $RGB[1], $RGB[2]);
                } else {
                    $RGB = $color;
                    $HSB = $this->RGBToHSB($RGB[0], $RGB[1], $RGB[2]);
                }
                $this->SendDebug('setColor - RGB Values for HSB Conversion', 'R: ' . $RGB[0] . ', G: ' . $RGB[1] . ', B: ' . $RGB[2], 0);
                $HSB = $this->RGBToHSB($RGB[0], $RGB[1], $RGB[2]);
                if ($Z2MMode == 'color') {
                    $Payload = [
                        'color' => [
                            'hue'        => $HSB['hue'],
                            'saturation' => $HSB['saturation'],
                        ]
                    ];
                } else {
                    return;
                }
                $PayloadJSON = json_encode($Payload, JSON_UNESCAPED_SLASHES);
                $this->Z2MSet($PayloadJSON);
                break;
            default:
                $this->SendDebug('setColor', 'Invalid Mode ' . $mode, 0);
                break;
        }
    }

    // Folgende Funktionen entfallen durch das neue RequestAction:
        // private function OnOff(bool $Value)
        // private function ValveState(bool $Value)
        // private function LockUnlock(bool $Value)
        // private function OpenClose(bool $Value)
        // private function AutoManual(bool $Value)

    private function registerVariableProfile($expose)
    {
        $ProfileName = 'Z2M.' . $expose['name'];
        $unit = isset($expose['unit']) ? ' ' . $expose['unit'] : '';
        $unitsThatRequireFloat = ['V', 'W', 'A', '°C', 'kWh', 'm', 'cm', 'mm', 'ft', 'in', 'l', 'ml', 'g', 'kg', 'psi', 'Pa', 'hPa', 'bar', 'm/s', 'km/h', 'mph', '°', 'rad', 'Hz', 'dB', 'lux', '%', 'ppm', 'ppb'];

        switch ($expose['type']) {
            case 'binary':
                switch ($expose['property']) {
                    case 'consumer_connected':
                        if (!IPS_VariableProfileExists($ProfileName)) {
                            $this->RegisterProfileBooleanEx($ProfileName, 'Plug', '', '', [
                                [false, $this->Translate('not connected'), '', 0xFF0000],
                                [true, $this->Translate('connected'), '', 0x00FF00]
                            ]);
                        }
                        break;
                    default:
                        $this->SendDebug(__FUNCTION__ . ':: Variableprofile missing', $ProfileName, 0);
                        break;
                }
                break;

            case 'enum':
                if (array_key_exists('values', $expose)) {
                    sort($expose['values']); // Sortieren, um Konsistenz beim Hashing zu gewährleisten
                    $tmpProfileName = implode('', $expose['values']);
                    $ProfileName .= '.' . dechex(crc32($tmpProfileName));

                    if (!IPS_VariableProfileExists($ProfileName)) {
                        $profileValues = [];
                        foreach ($expose['values'] as $value) {
                            $readableValue = ucwords(str_replace('_', ' ', $value));
                            $translatedValue = $this->Translate($readableValue);
                            if ($translatedValue === $readableValue) {
                                $this->SendDebug(__FUNCTION__ . ':: Missing Translation', "Keine Übersetzung für Wert: $readableValue", 0);
                            }
                            $profileValues[] = [$value, $translatedValue, '', 0x00FF00]; // Beispiel für eine Standardfarbe
                        }
                        $this->RegisterProfileStringEx($ProfileName, 'Menu', '', '', $profileValues);
                    }
                } else {
                    $this->SendDebug(__FUNCTION__ . ':: Variableprofile missing', $ProfileName, 0);
                    $this->SendDebug(__FUNCTION__ . ':: ProfileName Values', json_encode($expose['values']), 0);
                    return false;
                }
                break;

            case 'numeric':
                $fullRangeProfileName = $ProfileName . ($expose['value_min'] ?? '') . '_' . ($expose['value_max'] ?? '');
                $presetProfileName = $fullRangeProfileName . '_Presets';
                if (!IPS_VariableProfileExists($fullRangeProfileName)) {
                    if (in_array(trim($unit), $unitsThatRequireFloat) || isset($expose['value_step']) && is_float($expose['value_step'])) {
                        // Erstelle ein Float-Profil, wenn die Einheit eine Dezimaleinheit ist oder 'step' ein Float ist
                        $this->RegisterProfileFloat($fullRangeProfileName, 'Bulb', '', $unit, $expose['value_min'] ?? 0, $expose['value_max'] ?? 0, $expose['value_step'] ?? 0.1);
                    } else {
                        // Andernfalls erstelle ein Integer-Profil
                        $this->RegisterProfileInteger($fullRangeProfileName, 'Bulb', '', $unit, $expose['value_min'] ?? 0, $expose['value_max'] ?? 0, 1);
                    }
                }

                if (isset($expose['presets']) && !empty($expose['presets'])) {
                    if (IPS_VariableProfileExists($presetProfileName)) {
                        IPS_DeleteVariableProfile($presetProfileName);
                    }
                    $this->RegisterProfileInteger($presetProfileName, 'Bulb', '', '', 0, 0, 0);
                    foreach ($expose['presets'] as $preset) {
                        $presetValue = $preset['value'];
                        $presetName = $this->Translate(ucwords(str_replace('_', ' ', $preset['name'])));
                        IPS_SetVariableProfileAssociation($presetProfileName, $presetValue, $presetName, '', 0xFFFFFF);
                    }
                }

                return ['mainProfile' => $fullRangeProfileName, 'presetProfile' => $presetProfileName];
            default:
                $this->SendDebug(__FUNCTION__ . ':: Type not handled', $ProfileName, 0);
                return false;
        }
    }

    private function mapExposesToVariables(array $exposes)
    {
        foreach ($exposes as $expose) {
            if (isset($expose['features']) && is_array($expose['features'])) {
                // Handle nested features for types like 'switch'
                foreach ($expose['features'] as $feature) {
                    $this->processFeature($feature);
                }
            } else {
                // Directly process the expose if it does not contain nested features
                $this->processFeature($expose);
            }
        }
    }

    private function processFeature($expose)
    {
        if (!isset($expose['property'])) {
            $this->SendDebug(__FUNCTION__ . ':: Missing property key', json_encode($expose), 0);
            return; // Skip this expose if the property key is missing
        }

        $ident = $this->convertKeyToIdent($expose['property']);
        $translation = $this->Translate($expose['label']);
        $profileResult = $this->registerVariableProfile($expose);
        if (!$profileResult) {
            $this->SendDebug(__FUNCTION__ . ':: Profile creation failed', json_encode($expose), 0);
            return; // Skip this expose if profile creation fails
        }

        $profileName = is_array($profileResult) ? $profileResult['mainProfile'] : $profileResult;
        $variableID = $this->registerVariable($ident, $translation, $profileName, $expose['type'], $expose);

        if ($variableID) {
            if (isset($expose['access']) && ($expose['access'] & 0b010)) {
                $this->EnableAction($variableID);
            }
        } else {
            $this->SendDebug(__FUNCTION__, 'Failed to create variable with ident: ' . $ident, 0);
        }
    }

        private function registerVariable($ident, $translation, $profileName, $featureType, $expose)
        {
            switch ($featureType) {
                case 'numeric':
                    // Bestimme, ob eine Float-Variable basierend auf der Einheit angelegt werden soll
                    $unit = $expose['unit'] ?? '';
                    $step = $expose['value_step'] ?? 1;
                    $unitsThatRequireFloat = ['W', 'V', 'A', '°C'];  // Liste der Einheiten, die Float benötigen

                    if (in_array($unit, $unitsThatRequireFloat) || is_float($step) || strpos((string)$step, '.') !== false) {
                        // Wenn die Einheit in der Liste ist oder 'step' ein Dezimalwert ist, erstelle eine Float-Variable
                        return $this->RegisterVariableFloat($ident, $translation, $profileName);
                    } else if (isset($expose['value_min']) && isset($expose['value_max'])) {
                        // Sonst, wenn 'value_min' und 'value_max' definiert sind, erstelle eine Integer-Variable
                        return $this->RegisterVariableInteger($ident, $translation, $profileName);
                    } else {
                        // Standardmäßig eine Float-Variable erstellen, wenn keine min/max Werte angegeben sind
                        return $this->RegisterVariableFloat($ident, $translation, $profileName);
                    }
                    break;
                case 'binary':
                    return $this->RegisterVariableBoolean($ident, $translation, $profileName);
                case 'enum':
                    return $this->RegisterVariableString($ident, $translation, $profileName);
                default:
                    $this->SendDebug(__FUNCTION__ . ':: Unsupported type', $featureType, 0);
                    return false;
            }
        }
}
