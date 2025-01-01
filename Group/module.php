<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/libs/ModulBase.php';

class Zigbee2MQTTGroup extends \Zigbee2MQTT\ModulBase
{
    /** @var mixed $ExtensionTopic Topic für den ReceiveFilter */
    protected static $ExtensionTopic = 'getGroupInfo/';

    /**
     * Create
     *
     * @return void
     */
    public function Create()
    {
        // Never delete this line!
        parent::Create();
        $this->RegisterPropertyInteger('GroupId', 0);
    }

    /**
     * ApplyChanges
     *
     * @return void
     */
    public function ApplyChanges()
    {
        $GroupId = $this->ReadPropertyInteger('GroupId');
        $GroupId = $GroupId ? 'Group Id: ' . $GroupId : '';
        $this->SetSummary($GroupId);

        // Führe parent::ApplyChanges zuerst aus
        parent::ApplyChanges();
    }

    /**
     * RequestAction
     *
     * @param  string $ident
     * @param  mixed $value
     * @return void
     */
    public function RequestAction($ident, $value)
    {
        if ($ident == 'ShowGroupIdEditWarning') {
            $this->UpdateFormField('GroupIdWarning', 'visible', true);
            return;
        }
        if ($ident == 'EnableGroupIdEdit') {
            $this->UpdateFormField('GroupId', 'enabled', true);
            return;
        }
        parent::RequestAction($ident, $value);
    }

    /**
     * UpdateDeviceInfo
     *
     * Exposes von der Erweiterung in Z2M anfordern und verarbeiten.
     *
     * @return bool
     */
    protected function UpdateDeviceInfo(): bool
    {
        // Aufruf der Methode aus der ModulBase-Klasse
        $Result = $this->LoadDeviceInfo();
        if (!$Result) {
            return false;
        }
        if (!isset($Result['foundGroup'])) {
            trigger_error($this->Translate('Group not found. Check topic.'), E_USER_NOTICE);
            return false;

        }
        unset($Result['foundGroup']);
        // Aufruf der Methode aus der ModulBase-Klasse
        $SaveResult = $this->SaveExposesToJson($Result);
        $this->mapExposesToVariables($Result);
        return $SaveResult;
    }
}
