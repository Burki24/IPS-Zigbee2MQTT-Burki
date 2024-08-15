<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/libs/BufferHelper.php';
require_once dirname(__DIR__) . '/libs/SemaphoreHelper.php';
require_once __DIR__ . '/../libs/MQTTHelper.php';

/**
 * @property array $TransactionData
 */
class Zigbee2MQTTConfigurator extends IPSModule
{
    use \Zigbee2MQTT\BufferHelper;
    use \Zigbee2MQTT\Semaphore;
    use \Zigbee2MQTT\MQTTHelper;

    public function Create()
    {
        //Never delete this line!
        parent::Create();
        $this->ConnectParent('{C6D2AEB3-6E1F-4B2E-8E69-3A1A00246850}');
        $this->RegisterPropertyString('MQTTBaseTopic', 'zigbee2mqtt');
        $this->TransactionData = [];
    }

    public function ApplyChanges()
    {
        //Never delete this line!
        parent::ApplyChanges();

        $BaseTopic = $this->ReadPropertyString('MQTTBaseTopic');
        if (empty($BaseTopic)) {
            $this->SetStatus(IS_INACTIVE);
            $this->SetReceiveDataFilter('NOTHING_TO_RECEIVE'); //block all
            return;
        }
        $this->SetStatus(IS_ACTIVE);
        //Setze Filter für ReceiveData
        $this->SetReceiveDataFilter('.*"Topic":"' . $BaseTopic . '/SymconExtension/lists/response.*');
    }

    public function GetConfigurationForm()
    {
        $BaseTopic = $this->ReadPropertyString('MQTTBaseTopic');
        $Devices = [];
        $Groups = [];
        if (!empty($BaseTopic)) {
            if (($this->HasActiveParent()) && (IPS_GetKernelRunlevel() == KR_READY)) {
                $Devices = $this->getDevices();
                $Groups = $this->getGroups();
            }
        }
        $this->SendDebug('NetworkDevices', json_encode($Devices), 0);
        $IPSDevicesByIEEE = $this->GetIPSInstancesByIEEE();
        $this->SendDebug('IPS Devices IEEE', json_encode($IPSDevicesByIEEE), 0);
        $IPSDevicesByTopic = $this->GetIPSInstancesByBaseTopic('{E5BB36C6-A70B-EB23-3716-9151A09AC8A2}', $BaseTopic);
        $this->SendDebug('IPS Devices Topic', json_encode($IPSDevicesByTopic), 0);
        $Form = json_decode(file_get_contents(__DIR__ . '/form.json'), true);
        /**
         * Todo:
         * Wenn beides Arrays leer sind, Hinweis das die Erweiterung fehlt oder veraltet ist
         * PopUp mit Button um zur Bridge zu springen? -> Sofern Instanz gefunden wurde
         * Bridge mit Aufnehmen in die Geräteliste?!
         */

        //Devices
        $ValuesDevices = [];
        foreach ($Devices as $device) {
            $Value = []; //Array leeren
            $instanceID = array_search($device['ieeeAddr'], $IPSDevicesByIEEE);
            if ($instanceID) { //erst nach IEEE suchen
                unset($IPSDevicesByIEEE[$instanceID]);
                if (array_key_exists($instanceID, $IPSDevicesByTopic)) { //wenn auch in IPSDevicesByTopic vorhanden, hier löschen
                    unset($IPSDevicesByTopic[$instanceID]);
                }
            } else { // dann nach Topic suchen
                $instanceID = array_search($device['friendly_name'], $IPSDevicesByTopic);
                unset($IPSDevicesByTopic[$instanceID]);
                if (array_key_exists($instanceID, $IPSDevicesByIEEE)) { //wenn auch in IPSDevicesByIEEE vorhanden, hier löschen
                    unset($IPSDevicesByIEEE[$instanceID]);
                }
            }
            if ($instanceID) {
                $Value['name'] = IPS_GetName($instanceID);
                $Value['instanceID'] = $instanceID;

            } else {
                $Value['name'] = $device['friendly_name'];
                $Value['instanceID'] = 0;
            }
            $Value['ieee_address'] = $device['ieeeAddr'];
            $Value['networkAddress'] = $device['networkAddress'];
            $Value['type'] = $device['type'];
            $Value['vendor'] = (array_key_exists('vendor', $device) ? $device['vendor'] : $this->Translate('Unknown'));
            $Value['modelID'] = (array_key_exists('modelID', $device) ? $device['modelID'] : $this->Translate('Unknown'));
            $Value['description'] = (array_key_exists('description', $device) ? $device['description'] : $this->Translate('Unknown'));
            $Value['power_source'] = (array_key_exists('powerSource', $device) ? $this->Translate($device['powerSource']) : $this->Translate('Unknown'));
            $Value['create'] =
                [
                    'moduleID'      => '{E5BB36C6-A70B-EB23-3716-9151A09AC8A2}',
                    'configuration' => [
                        'MQTTBaseTopic'    => $BaseTopic,
                        'MQTTTopic'        => $device['friendly_name'],
                        'IEEE'             => $device['ieeeAddr']
                    ]
                ];
            array_push($ValuesDevices, $Value);
        }
        foreach ($IPSDevicesByIEEE as $instanceID => $IEEE) {
            if (array_key_exists($instanceID, $IPSDevicesByTopic)) { //wenn auch in IPSDevicesByTopic vorhanden, hier löschen
                unset($IPSDevicesByTopic[$instanceID]);
            }

            $ValuesDevices[] = [
                'name'               => IPS_GetName($instanceID),
                'instanceID'         => $instanceID,
                'ieee_address'       => $IEEE,
                'networkAddress'     => '',
                'type'               => '',
                'vendor'             => '',
                'modelID'            => '',
                'description'        => '',
                'power_source'       => ''

            ];
        }
        foreach ($IPSDevicesByTopic as $instanceID => $Topic) {
            $ValuesDevices[] = [
                'name'               => IPS_GetName($instanceID),
                'instanceID'         => $instanceID,
                'ieee_address'       => IPS_GetProperty($instanceID, 'IEEE'),
                'networkAddress'     => '',
                'type'               => '',
                'vendor'             => '',
                'modelID'            => '',
                'description'        => '',
                'power_source'       => ''

            ];
        }
        $Form['actions'][0]['items'][0]['values'] = $ValuesDevices;
        $Form['actions'][0]['items'][0]['rowCount'] = (count($ValuesDevices) < 35 ? count($ValuesDevices) : 35);

        //Groups
        $this->SendDebug('NetworkGroups', json_encode($Groups), 0);
        $IPSGroupById = $this->GetIPSInstancesByGroupId();
        $this->SendDebug('IPS Group Id', json_encode($IPSGroupById), 0);
        $IPSGroupByTopic = $this->GetIPSInstancesByBaseTopic('{11BF3773-E940-469B-9DD7-FB9ACD7199A2}', $BaseTopic);
        $this->SendDebug('IPS Group Topic', json_encode($IPSGroupByTopic), 0);

        $ValuesGroups = [];
        foreach ($Groups as $group) {
            $Value = []; //Array leeren
            $instanceID = array_search($group['ID'], $IPSGroupById);
            if ($instanceID) { //erst nach ID suchen
                unset($IPSGroupById[$instanceID]);
                if (array_key_exists($instanceID, $IPSGroupByTopic)) { //wenn auch in IPSGroupByTopic vorhanden, hier löschen
                    unset($IPSGroupByTopic[$instanceID]);
                }
            } else { // dann nach Topic suchen
                $instanceID = array_search($group['friendly_name'], $IPSGroupByTopic);
                unset($IPSGroupByTopic[$instanceID]);
                if (array_key_exists($instanceID, $IPSGroupById)) { //wenn auch in IPSGroupById vorhanden, hier löschen
                    unset($IPSGroupById[$instanceID]);
                }
            }
            if ($instanceID) {
                $Value['name'] = IPS_GetName($instanceID);
                $Value['instanceID'] = $instanceID;

            } else {
                $Value['name'] = $group['friendly_name'];
                $Value['instanceID'] = 0;
            }
            $Value['ID'] = $group['ID'];
            $Value['DevicesCount'] = (string) count($group['devices']);
            $Value['create'] =
                [
                    'moduleID'      => '{11BF3773-E940-469B-9DD7-FB9ACD7199A2}',
                    'configuration' => [
                        'MQTTBaseTopic'    => $BaseTopic,
                        'MQTTTopic'        => $group['friendly_name'],
                        'GroupId'          => $group['ID']
                    ]
                ];
            array_push($ValuesGroups, $Value);
        }
        foreach ($IPSGroupById as $instanceID => $ID) {
            if (array_key_exists($instanceID, $IPSGroupByTopic)) { //wenn auch in IPSGroupByTopic vorhanden, hier löschen
                unset($IPSGroupByTopic[$instanceID]);
            }

            $ValuesGroups[] = [
                'name'               => IPS_GetName($instanceID),
                'instanceID'         => $instanceID,
                'ID'                 => $ID,
                'DevicesCount'       => ''

            ];
        }
        foreach ($IPSGroupByTopic as $instanceID => $Topic) {
            $ValuesGroups[] = [
                'name'               => IPS_GetName($instanceID),
                'instanceID'         => $instanceID,
                'ID'                 => IPS_GetProperty($instanceID, 'GroupId'),
                'DevicesCount'       => ''

            ];
        }
        $Form['actions'][1]['items'][0]['values'] = $ValuesGroups;
        $Form['actions'][1]['items'][0]['rowCount'] = (count($ValuesGroups) < 35 ? count($ValuesGroups) : 35);
        return json_encode($Form);
    }

    public function ReceiveData($JSONString)
    {
        $BaseTopic = $this->ReadPropertyString('MQTTBaseTopic');
        if (empty($BaseTopic)) {
            return '';
        }
        $this->SendDebug('JSON', $JSONString, 0);
        $Buffer = json_decode($JSONString, true);

        if (!isset($Buffer['Topic'])) {
            return '';
        }

        $ReceiveTopic = $Buffer['Topic'];
        $this->SendDebug('MQTT FullTopic', $ReceiveTopic, 0);
        $Topic = substr($ReceiveTopic, strlen($BaseTopic . '/SymconExtension/lists/'));
        $Topics = explode('/', $Topic);
        $Topic = array_shift($Topics);
        $this->SendDebug('MQTT Topic', $Topic, 0);
        $this->SendDebug('MQTT Payload', utf8_decode($Buffer['Payload']), 0);
        if ($Topic != 'response') {
            return '';
        }
        $Payload = json_decode(utf8_decode($Buffer['Payload']), true);
        if (isset($Payload['transaction'])) {
            $this->UpdateTransaction($Payload);
        }
        return '';
    }

    public function getDevices()
    {
        $Result = @$this->SendData('/SymconExtension/lists/request/getDevices');
        if ($Result) {
            return $Result['list'];
        }
        return [];
    }

    public function getGroups()
    {
        $Result = @$this->SendData('/SymconExtension/lists/request/getGroups');
        if ($Result) {
            return $Result['list'];
        }
        return [];
    }

    private function GetIPSInstancesByIEEE(): array
    {
        $Devices = [];
        $InstanceIDList = array_filter(IPS_GetInstanceListByModuleID('{E5BB36C6-A70B-EB23-3716-9151A09AC8A2}'));
        $InstanceIDList = array_filter($InstanceIDList, [$this, 'FilterInstances']);
        foreach ($InstanceIDList as $InstanceID) {
            $Devices[$InstanceID] = IPS_GetProperty($InstanceID, 'IEEE');
        }
        return $Devices;
    }
    private function GetIPSInstancesByGroupId(): array
    {
        $Devices = [];
        $InstanceIDList = array_filter(IPS_GetInstanceListByModuleID('{11BF3773-E940-469B-9DD7-FB9ACD7199A2}'));
        $InstanceIDList = array_filter($InstanceIDList, [$this, 'FilterInstances']);
        foreach ($InstanceIDList as $InstanceID) {
            $Devices[$InstanceID] = IPS_GetProperty($InstanceID, 'GroupId');
        }
        return $Devices;
    }

    private function GetIPSInstancesByBaseTopic(string $GUID, string $BaseTopic): array
    {
        $Devices = [];
        $InstanceIDList = array_filter(IPS_GetInstanceListByModuleID($GUID), [$this, 'FilterInstances']);
        foreach ($InstanceIDList as $InstanceID) {
            if (IPS_GetProperty($InstanceID, 'MQTTBaseTopic') == $BaseTopic) {
                $Devices[$InstanceID] = IPS_GetProperty($InstanceID, 'MQTTTopic');
            }
        }
        return $Devices;
    }

    private function FilterInstances(int $InstanceID)
    {
        return IPS_GetInstance($InstanceID)['ConnectionID'] == IPS_GetInstance($this->InstanceID)['ConnectionID'];
    }

    private function getGroupInstanceID($FriendlyName)
    {
        $InstanceIDs = IPS_GetInstanceListByModuleID('{11BF3773-E940-469B-9DD7-FB9ACD7199A2}');
        foreach ($InstanceIDs as $id) {
            if (IPS_GetProperty($id, 'MQTTTopic') == $FriendlyName) {
                return $id;
            }
        }
        return 0;
    }
}