<?php

declare(strict_types=1);

namespace Zigbee2MQTT;

trait Zigbee2MQTTHelper
{
    public function RequestAction($Ident, $Value)
    {
        $variableID = $this->GetIDForIdent($Ident);
        $variableType = IPS_GetVariable($variableID)['VariableType'];
        switch ($Ident) {
            case 'Z2M_OccupancySensitivity':
                $Payload['occupancy_sensitivity'] = $Value;
                break;
            case 'Z2M_SmokeAlarmState':
                $Payload['smoke_alarm_state'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_IntruderAlarmState':
                $Payload['intruder_alarm_state'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_ActionLevel':
                $Payload['action_level'] = $Value;
                break;
            case 'Z2M_ScheduleSettings':
                $Payload['schedule_settings'] = $Value;
                break;
            case 'Z2M_schedule':
                $Payload['schedule'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_externalTemperatureInput':
                $Payload['external_temperature_input'] = $Value;
                break;
            case 'Z2M_Calibrate':
                $Payload['calibrate'] = $Value;
                break;
            case 'Z2M_Identify':
                $Payload['identify'] = $Value;
                break;
            case 'Z2M_TemperaturePeriodicReport':
                $Payload['temperature_periodic_report'] = $Value;
                break;
            case 'Z2M_HumidityPeriodicReport':
                $Payload['humidity_periodic_report'] = $Value;
                break;
            case 'Z2M_TemperatureSensitivity':
                $Payload['temperature_sensitivity'] = $Value;
                break;
            case 'Z2M_HumiditySensitivity':
                $Payload['humidity_sensitivity'] = $Value;
                break;
            case 'Z2M_AlarmRingtone':
                $Payload['alarm_ringtone'] = $Value;
                break;
            case 'Z2M_OpeningMode':
                $Payload['opening_mode'] = $Value;
                break;
            case 'Z2M_SetUpperLimit':
                $Payload['set_upper_limit'] = $Value;
                break;
            case 'Z2M_SetBottomLimit':
                $Payload['set_bottom_limit'] = $Value;
                break;
            case 'Z2M_TemperatureAlarm':
                $Payload['temperature_alarm'] = $Value;
                break;
            case 'Z2M_HumidityAlarm':
                $Payload['humidity_alarm'] = $Value;
                break;
            case'Z2M_MinHumidityAlarm':
                $Payload['min_humidity_alarm'] = $Value;
                break;
            case 'Z2M_MaxHumidityAlarm':
                $Payload['max_humidity_alarm'] = $Value;
                break;
            case 'Z2M_MaxTemperatureAlarm':
                $Payload['max_temperature_alarm'] = $Value;
                break;
            case 'Z2M_MinTemperatureAlarm':
                $Payload['min_temperature_alarm'] = $Value;
                break;
            case 'Z2M_Online':
                $Payload['online'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_WorkingDay':
                $Payload['working_day'] = $Value;
                break;
            case 'Z2M_WeekDay':
                $Payload['wek_day'] = $Value;
                break;
            case 'Z2M_CycleIrrigationNumTimes':
                $Payload['cycle_irrigation_num_times'] = $Value;
                break;
            case 'Z2M_IrrigationTarget':
                $Payload['irrigation_target'] = $Value;
                break;
            case 'Z2MCycleIrrigationInterval':
                $Payload['cycle_irrigation_interval'] = $Value;
                break;
            case 'Z2M_CountdownL1':
                $Payload['countdown_l1'] = $Value;
                break;
            case 'Z2M_CountdownL2':
                $Payload['countdown_l2'] = $Value;
                break;
            case 'Z2M_Presence_Timeout':
                $Payload['presence_timeout'] = $Value;
                break;
            case 'Z2M_RadarRange':
                $Payload['radar_range'] = $Value;
                break;
            case 'Z2M_MoveSensitivity':
                $Payload['move_sensitivity'] = $Value;
                break;
            case 'Z2M_ValveAdaptProcess':
                $Payload['valve_adapt_process'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_Indicator':
                $Payload['indicator'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_SmallDetectionSensitivity':
                $Payload['small_detection_sensitivity'] = $Value;
                break;
            case 'Z2M_SmallDetectionDistance':
                $Payload['small_detection_distance'] = $Value;
                break;
            case 'Z2M_MediumMotionDetectionDistance':
                $Payload['medium_motion_detection_distance'] = $Value;
                break;
            case 'Z2M_MediumMotionDetectionSensitivity':
                $Payload['medium_motion_detection_sensitivity'] = $Value;
                break;
            case 'Z2M_LargeMotionDetectionDistance':
                $Payload['large_motion_detection_distance'] = $Value;
                break;
            case 'Z2M_LargeMotionDetectionSensitivity':
                $Payload['large_motion_detection_sensitivity'] = $Value;
                break;
            case 'Z2M_DetectionDistance':
                $Payload['detection_distance'] = strval($Value);
                break;
            case 'Z2M_TransmitPower':
                $Payload['transmit_power'] = $Value;
                break;
            case 'Z2M_PresenceSensitivity':
                $Payload['presence_sensitivity'] = $Value;
                break;
            case 'Z2M_DetectionDistanceMin':
                $Payload['detection_distance_min'] = $Value;
                break;
            case 'Z2M_DetectionDistanceMax':
                $Payload['detection_distance_max'] = $Value;
                break;
            case 'Z2M_DeviceMode':
                $Payload['device_mode'] = $Value;
                break;
            case 'Z2M_MonitoringMode':
                $Payload['monitoring_mode'] = $Value;
                break;
            case 'Z2M_ApproachDistance':
                $Payload['approach_distance'] = $Value;
                break;
            case 'Z2M_ResetNopresenceStatus':
                $Payload['reset_nopresence_status'] = $Value;
                break;
            case 'Z2M_ScaleProtection':
                $Payload['scale_protection'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_LedIndication':
                $Payload['led_indication'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_Silence':
                $Payload['silence'] = $Value;
                break;
            case 'Z2M_LearnIRCode':
                $Payload['learn_ir_code'] = strval($this->OnOff($Value));
                break;
            case'Z2M_IRCodeToSend':
                $Payload['ir_code_to_send'] = $Value;
                break;
            case'Z2M_ProgrammingMode':
                $Payload['programming_mode'] = $Value;
                break;
            case 'Z2M_FanMode':
                $Payload['fan_mode'] = $Value;
                break;
            case 'Z2M_AlarmMode':
                $Payload['alarm_mode'] = $Value;
                break;
            case 'Z2M_AlarmMelody':
                $Payload['alarm_melody'] = $Value;
                break;
            case 'Z2M_AlarmTime':
                $Payload['alarm_time'] = $Value;
                break;
            case 'Z2M_TamperAlarmSwitch':
                $Payload['tamper_alarm_switch'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_AlarmSwitch':
                $Payload['alarm_switch'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_AlarmState':
                $Payload['alarm_state'] = $Value;
                break;
            case 'Z2M_PiHeatingDemand':
                $Payload['pi_heating_demand'] = $Value;
                break;
            case 'Z2M_DoNotDisturb':
                $Payload['do_not_disturb'] = $Value;
                break;
            case 'Z2M_MotorDirection':
                $Payload['motor_direction'] = strval($Value);
                break;
            case 'Z2M_ColorPowerOnBehavior':
                $Payload['color_power_on_behavior'] = strval($Value);
                break;
            case 'Z2M_DisplayedTemperature':
                $Payload['displayed_temperature'] = strval($Value);
                break;
            case 'Z2M_RemoteTemperature':
                $Payload['remote_temperature'] = strval($Value);
                break;
            case 'Z2M_TemperatureUnit':
                $Payload['temperature_unit'] = strval($Value);
                break;
            case 'Z2M_ButtonLock':
                $Payload['button_lock'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_WindowOpen':
                $Payload['window_open'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_MuteBuzzer':
                $Payload['mute_buzzer'] = strval($Value);
                break;
            case 'Z2M_AdaptationRunControl':
                $Payload['adaptation_run_control'] = strval($Value);
                break;
            case 'Z2M_DayOfWeek':
                $Payload['day_of_week'] = strval($Value);
                break;
            case 'Z2M_RegulationSetpointOffset':
                $Payload['regulation_setpoint_offset'] = strval($Value);
                break;
            case 'Z2M_LoadRoomMean':
                $Payload['load_room_mean'] = strval($Value);
                break;
            case 'Z2M_AlgorithmScaleFactor':
                $Payload['algorithm_scale_factor'] = strval($Value);
                break;
            case 'Z2M_AdaptationRunSettings':
                $Payload['adaptation_run_settings'] = strval($Value);
                break;
            case 'Z2M_TriggerTime':
                $Payload['trigger_time'] = strval($Value);
                break;
            case 'Z2M_LoadBalancingEnable':
                $Payload['load_balancing_enable'] = strval($Value);
                break;
            case 'Z2M_WindowOpenExternal':
                $Payload['window_open_external'] = strval($Value);
                break;
            case 'Z2M_WindowOpenFeature':
                $Payload['window_open_feature'] = strval($Value);
                break;
            case 'Z2M_RadiatorCovered':
                $Payload['radiator_covered'] = strval($Value);
                break;
            case 'Z2M_ExternalMeasuredRoomSensor':
                $Payload['external_measured_room_sensor'] = strval($Value);
                break;
            case 'Z2M_OccupiedHeatingSetpointScheduled':
                $Payload['occupied_heating_setpoint_scheduled'] = number_format($Value, 2, '.', ' ');
                break;
            case 'Z2M_HeatAvailable':
                $Payload['heat_available'] = strval($Value);
                break;
            case 'Z2M_ViewingDirection':
                $Payload['viewing_direction'] = strval($Value);
                break;
            case 'Z2M_ThermostatVerticalOrientation':
                $Payload['thermostat_vertical_orientation'] = strval($Value);
                break;
            case 'Z2M_MountedModeControl':
                $Payload['mounted_mode_control'] = strval($Value);
                break;
            case 'Z2M_ProgrammingOperationMode':
                $Payload['programming_operation_mode'] = strval($Value);
                break;
            case 'Z2M_Keypadlockout':
                $Payload['keypad_lockout'] = strval($Value);
                break;
            case 'Z2M_LinkageAlarm':
                $Payload['linkage_alarm'] = $Value;
                break;
            case 'Z2M_HeartbeatIndicator':
                $Payload['heartbeat_indicator'] = $Value;
                break;
            case 'Z2M_Buzzer':
                $Payload['buzzer'] = strval($Value);
                break;
            case 'Z2M_DisplayBrightness':
                $Payload['display_brightness'] = strval($Value);
                break;
            case 'Z2M_DisplayOntime':
                $Payload['display_ontime'] = strval($Value);
                break;
            case 'Z2M_DisplayOrientation':
                $Payload['display_orientation'] = strval($Value);
                break;
            case 'Z2M_Boost':
                $Payload['boost'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_StateRGB':
                $Payload['state_rgb'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_StateCCT':
                $Payload['state_cct'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_ComfortTemperature':
                $Payload['comfort_temperature'] = number_format($Value, 2, '.', ' ');
                break;
            case 'Z2M_ColorTempStartup':
                $Payload['color_temp_startup'] = strval($Value);
                break;
            case 'Z2M_GradientScene':
                $Payload['gradient_scene'] = strval($Value);
                break;
            case 'Z2M_Vibration':
                $Payload['vibration'] = strval($Value);
                break;
            case 'Z2M_AutoLock':
                $Payload['auto_lock'] = strval($this->AutoManual($Value));
                break;
            case 'Z2M_BoostHeatingCountdownTimeSet':
                $Payload['boost_heating_countdown_time_set'] = strval($Value);
                break;
            case 'Z2M_EcoTemperature':
                $Payload['eco_temperature'] = number_format($Value, 2, '.', ' ');
                break;
            case 'Z2M_ValveState':
                $Payload['valve_state'] = strval($this->ValveState($Value));
                break;
            case 'Z2M_ValvePosition':
                $Payload['valve_position'] = strval($Value);
                break;
            case 'Z2M_EcoMode':
                $Payload['eco_mode'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_FanState':
                $Payload['fan_state'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_MaxTemperature':
                $Payload['max_temperature'] = number_format($Value, 2, '.', ' ');
                break;
            case 'Z2M_MinTemperature':
                $Payload['min_temperature'] = number_format($Value, 2, '.', ' ');
                break;
            case 'Z2M_PowerOutageCount':
                $Payload['power_outage_count'] = strval($Value);
                break;
            case 'Z2M_SwitchType':
                $Payload['switch_type'] = strval($Value);
                break;
            case 'Z2M_IndicatorMode':
                $Payload['indicator_mode'] = strval($Value);
                break;
            case 'Z2M_TemperatureAlarm':
                $Payload['temperature_alarm'] = strval($Value);
                break;
            case 'Z2M_HumidityAlarm':
                $Payload['humidity_alarm'] = strval($Value);
                break;
            case 'Z2M_Alarm':
                $Payload['alarm'] = strval($Value);
                break;
            case 'Z2M_Melody':
                $Payload['melody'] = strval($Value);
                break;
            case 'Z2M_PowerType':
                $Payload['power_type'] = strval($Value);
                break;
            case 'Z2M_Volume':
                $Payload['volume'] = strval($Value);
                break;
            case 'Z2M_HumidityMax':
                $Payload['humidity_max'] = strval($Value);
                break;
            case 'Z2M_HumidityMin':
                $Payload['humidity_min'] = strval($Value);
                break;
            case 'Z2M_TemperatureMax':
                $Payload['temperature_max'] = number_format($Value, 2, '.', ' ');
                break;
            case 'Z2M_TemperatureMin':
                $Payload['temperature_min'] = number_format($Value, 2, '.', ' ');
                break;
                case 'Z2M_BacklightMode':
                    if ($variableType == 3) {
                        $Payload['backlight_mode'] = ($Value);
                        break;
                    }
                    $Payload['backlight_mode'] = strval($this->OnOff($Value));
                    break;
            case 'Z2M_LedState':
                $Payload['led_state'] = strval($Value);
                break;
            case 'Z2M_LEDEnable':
                $Payload['led_enable'] = $Value;
                break;
            case 'Z2M_ActionRate':
                $Payload['action_rate'] = $Value;
                break;
            case 'Z2M_ActionStepSize':
                $Payload['action_step_size'] = strval($Value);
                break;
            case 'Z2M_ActionTransTime':
                $Payload['action_transition_time'] = strval($Value);
                break;
            case 'Z2M_ActionGroup':
                $Payload['action_group'] = strval($Value);
                break;
            case 'Z2M_ActionColorTemp':
                $Payload['action_color_temperature'] = strval($Value);
                break;
            case 'Z2M_Brightness':
                $Payload['brightness'] = strval($Value);
                break;
            case 'Z2M_BrightnessL1':
                $Payload['brightness_l1'] = ($Value);
                break;
            case 'Z2M_BrightnessL2':
                $Payload['brightness_l2'] = ($Value);
                break;
            case 'Z2M_MaxBrightnessL1':
                $Payload['max_brightness_l1'] = ($Value);
                break;
            case 'Z2M_MinBrightnessL1':
                $Payload['min_brightness_l1'] = ($Value);
                break;
            case 'Z2M_MaxBrightnessL2':
                $Payload['max_brightness_l2'] = ($Value);
                break;
            case 'Z2M_MinBrightnessL2':
                $Payload['min_brightness_l2'] = ($Value);
                break;
            case 'Z2M_BrightnessRGB':
                $Payload['brightness_rgb'] = strval($Value);
                break;
            case 'Z2M_BrightnessCCT':
                $Payload['brightness_cct'] = strval($Value);
                break;
            case 'Z2M_BrightnessWhite':
                $Payload['brightness_white'] = strval($Value);
                break;
            case 'Z2M_ColorTemp':
                $Payload['color_temp'] = strval($Value);
                break;
            case 'Z2M_ColorTempKelvin':
                $Payload['color_temp'] = strval(intval(round(1000000 / $Value, 0)));
                break;
            case 'Z2M_ColorTempRGB':
                $Payload['color_temp_rgb'] = strval($Value);
                break;
            case 'Z2M_ColorTempCCT':
                $Payload['color_temp_cct'] = strval($Value);
                break;
            case 'Z2M_State':
                if ($variableType == 3) {
                    $Payload['state'] = strval($Value);
                    break;
                }
                $Payload['state'] = strval($this->OnOff($Value));
                break;
            // case 'Z2M_StateLeft':
            //     $Payload['state_left'] = strval($Value);
            //     break;
            // case 'Z2M_StateRight':
            //     $Payload['state_right'] = strval($Value);
            //     break;
            case 'Z2M_RunningState':
                $Payload['running_state'] = strval($Value);
                break;
            case 'Z2M_Sensor':
                $Payload['sensor'] = strval($Value);
                break;
            case 'Z2M_StateRGB':
                $Payload['state_rgb'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_StateCCT':
                $Payload['state_cct'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_StateWhite':
                $Payload['state_white'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_LEDDisabledNight':
                $Payload['led_disabled_night'] = strval($Value);
                break;
            case 'Z2M_Statel1':
                $Payload['state_l1'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_Statel2':
                $Payload['state_l2'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_Statel3':
                $Payload['state_l3'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_Statel4':
                $Payload['state_l4'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_Statel5':
                $Payload['state_l5'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_Statel6':
                $Payload['state_l6'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_Statel7':
                $Payload['state_l7'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_Statel8':
                $Payload['state_l8'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_state_left':
                if ($variableType == 3) {
                    $Payload['state_left'] = strval($Value);
                    break;
                }
                $Payload['state_left'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_state_right':
                if ($variableType == 3) {
                    $Payload['state_right'] = strval($Value);
                    break;
                }
                $Payload['state_right'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_WindowDetection':
                $Payload['window_detection'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_OpenWindow':
                $Payload['open_window'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_ValveDetection':
                $Payload['valve_detection'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_ChildLock':
                $Payload['child_lock'] = strval($this->LockUnlock($Value));
                break;
            case'Z2M_PowerOutageMemory':
                $Payload['power_outage_memory'] = strval($Value);
                break;
            case'Z2M_PowerOnBehavior':
                $Payload['power_on_behavior'] = strval($Value);
                break;
            case'Z2M_PowerOnBehaviorL1':
                $Payload['power_on_behavior_l1'] = strval($Value);
                break;
            case'Z2M_PowerOnBehaviorL2':
                $Payload['power_on_behavior_l2'] = strval($Value);
                break;
            case'Z2M_PowerOnBehaviorL3':
                $Payload['power_on_behavior_l3'] = strval($Value);
                break;
            case'Z2M_PowerOnBehaviorL4':
                $Payload['power_on_behavior_l4'] = strval($Value);
                break;
            case'Z2M_AutoOff':
                $Payload['auto_off'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_StateWindow':
                $Payload['state'] = strval($this->OpenClose($Value));
                break;
            case 'Z2M_Sensitivity':
                $Payload['sensitivity'] = strval($Value);
                break;
            case 'Z2M_RadarSensitivity':
                $Payload['radar_sensitivity'] = strval($Value);
                break;
            case 'Z2M_RadarScene':
                $Payload['radar_scene'] = strval($Value);
                break;
            case 'Z2M_MotorWorkingMode':
                $Payload['motor_working_mode'] = strval($Value);
                break;
            case 'Z2M_Control':
                $Payload['control'] = strval($Value);
                break;
            case 'Z2M_BoostHeating':
                $Payload['boost_heating'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_FrostProtection':
                $Payload['frost_protection'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_HeatingStop':
                $Payload['heating_stop'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_Force':
                $Payload['force'] = strval($Value);
                break;
            case 'Z2M_Moving':
                $Payload['moving'] = strval($Value);
                break;
            case 'Z2M_MovingLeft':
                $Payload['moving_left'] = strval($Value);
                break;
            case 'Z2M_MovingRight':
                $Payload['moving_right'] = strval($Value);
                break;
            case 'Z2M_TRVMode':
                $Payload['trv_mode'] = strval($Value);
                break;
            case 'Z2M_Calibration':
                $Payload['calibration'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_CalibrationLeft':
                $Payload['calibration_left'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_CalibrationRight':
                $Payload['calibration_right'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_MotorReversal':
                $Payload['motor_reversal'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_MotorReversalLeft':
                $Payload['motor_reversal_left'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_MotorReversalRight':
                $Payload['motor_reversal_right'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_CurrentHeatingSetpoint':
                $Payload['current_heating_setpoint'] = $Value;
                break;
            case 'Z2M_CurrentHeatingSetpointAuto':
                $Payload['current_heating_setpoint_auto'] = $Value;
                break;
            case 'Z2M_OccupiedHeatingSetpoint':
                $Payload['occupied_heating_setpoint'] = $Value;
                break;
            case 'Z2M_LocalTemperatureCalibration':
                $Payload['local_temperature_calibration'] = number_format($Value, 2, '.', ' ');
                break;
            case 'Z2M_OpenWindowTemperature':
                $Payload['open_window_temperature'] = number_format($Value, 2, '.', ' ');
                break;
            case 'Z2M_HolidayTemperature':
                $Payload['holiday_temperature'] = number_format($Value, 2, '.', ' ');
                break;
            case 'Z2M_BoostTimesetCountdown':
                $Payload['boost_timeset_countdown'] = strval($Value);
                break;
            case 'Z2M_Preset':
                $Payload['preset'] = strval($Value);
                break;
            case 'Z2M_AwayPresetDays':
                $Payload['away_preset_days'] = strval($Value);
                break;
            case 'Z2M_AwayMode':
                $Payload['away_mode'] = strval($Value);
                break;
            case 'Z2M_BoostTime':
                $Payload['boost_time'] = strval($Value);
                break;
            case 'Z2M_SystemMode':
                $Payload['system_mode'] = strval($Value);
                break;
            case 'Z2M_Color':
                $this->SendDebug(__FUNCTION__ . ' Color', $Value, 0);
                $this->setColor($Value, 'cie');
                return;
            case 'Z2M_ColorHS':
                $this->SendDebug(__FUNCTION__ . ' Color HS', $Value, 0);
                $this->setColor($Value, 'hs');
                return;
            case 'Z2M_ColorRGB':
                $this->SendDebug(__FUNCTION__ . ' :: Color RGB', $Value, 0);
                $this->setColor($Value, 'cie', 'color_rgb');
                return;
            case 'Z2M_Position':
                $Payload['position'] = $Value;
                break;
            case 'Z2M_PositionLeft':
                $Payload['position_left'] = $Value;
                break;
            case 'Z2M_PositionRight':
                $Payload['position_right'] = $Value;
                break;
            case 'Z2M_MotorSpeed':
                $Payload['motor_speed'] = strval($Value);
                break;
            case 'Z2M_RegionID':
                $Payload['region_id'] = strval($Value);
                break;
            case 'Z2M_MotionSensitivity':
                $Payload['motion_sensitivity'] = strval($Value);
                break;
            case 'Z2M_OccupancyTimeout':
                $Payload['occupancy_timeout'] = strval($Value);
                break;
            case 'Z2M_OverloadProtection':
                $Payload['overload_protection'] = strval($Value);
                break;
            case 'Z2M_Mode':
                $Payload['mode'] = strval($Value);
                break;
            case 'Z2M_Week':
                $Payload['week'] = strval($Value);
                break;
            case 'Z2M_ControlBackMode':
                $Payload['control_back_mode'] = strval($Value);
                break;
            case 'Z2M_Border':
                $Payload['border'] = strval($Value);
                break;
            case 'Z2M_Level':
                $Payload['level'] = strval($Value);
                break;
            case 'Z2M_StrobeLevel':
                $Payload['strobe_level'] = strval($Value);
                break;
            case 'Z2M_Strobe':
                $Payload['strobe'] = strval($Value);
                break;
            case 'Z2M_StrobeDutyCycle':
                $Payload['strobe_duty_cycle'] = strval($Value);
                break;
            case 'Z2M_Duration':
                $Payload['duration'] = strval($Value);
                break;
            case 'Z2M_MinimumRange':
                $Payload['minimum_range'] = strval($Value);
                break;
            case 'Z2M_MaximumRange':
                $Payload['maximum_range'] = strval($Value);
                break;
            case 'Z2M_DeadzoneTemperature':
                $Payload['deadzone_temperature'] = strval($Value);
                break;
            case 'Z2M_MaxTemperatureLimit':
                $Payload['max_temperature_limit'] = strval($Value);
                break;
            case 'Z2M_DetectionDelay':
                $Payload['detection_delay'] = strval($Value);
                break;
            case 'Z2M_DetectionInterval':
                $Payload['detection_interval'] = strval($Value);
                break;
            case 'Z2M_Effect':
                $Payload['effect'] = strval($Value);
                break;
            case 'Z2M_FadingTime':
                $Payload['fading_time'] = strval($Value);
                break;
            case 'Z2M_SelfTest':
                $Payload['self_test'] = strval($Value);
                break;
            case 'Z2M_GarageTrigger':
                $Payload['trigger'] = $Value;
                break;
            case 'Z2M_GarageDoorContact':
                $Payload['garage_door_contact'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_BrightnessLevel':
                $Payload['brightness_level'] = strval($Value);
                break;
            case 'Z2M_TriggerIndicator':
                $Payload['trigger_indicator'] = strval($this->OnOff($Value));
                break;
            case 'Z2M_FactoryReset':
                $Payload['factory_reset'] = strval($this->OnOff($Value));
                break;
            default:
                $this->SendDebug('Request Action', 'No Action defined: ' . $Ident, 0);
                return false;
        }

        $PayloadJSON = json_encode($Payload, JSON_UNESCAPED_SLASHES);
        $this->Z2MSet($PayloadJSON);
    }

    public function getDeviceInfo()
    {
        $this->symconExtensionCommand('getDevice', $this->ReadPropertyString('MQTTTopic'));
    }

    public function getGroupInfo()
    {
        $this->symconExtensionCommand('getGroup', $this->ReadPropertyString('MQTTTopic'));
    }

    public function ReceiveData($JSONString)
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

            $Payload = json_decode($Buffer['Payload'], true);
            if (is_array($Payload)) {
                if (array_key_exists('last_seen', $Payload)) {
                    //Last Seen ist nicht in den Exposes enthalten, deswegen hier.
                    $this->RegisterVariableInteger('Z2M_LastSeen', $this->Translate('Last Seen'), '~UnixTimestamp');
                    $this->SetValue('Z2M_LastSeen', ($Payload['last_seen'] / 1000));
                }
                if (array_key_exists('execute_if_off', $Payload)) {
                    $this->handleStateChange('execute_if_off', 'Z2M_ExecuteIfOff', 'Execute If Off', $Payload);
                }
                if (array_key_exists('illumination', $Payload)) {
                    $this->SetValue('Z2M_Illumination', $Payload['illumination']);
                }
                if (array_key_exists('occupancy_sensitivity', $Payload)) {
                    $this->SetValue('Z2M_OccupancySensitivity', $Payload['occupancy_sensitivity']);
                }
                if (array_key_exists('smoke_alarm_state', $Payload)) {
                    $this->handleStateChange('smoke_alarm_state', 'Z2M_SmokeAlarmState', 'Smoke Alarm State', $Payload);
                }
                if (array_key_exists('intruder_alarm_state', $Payload)) {
                    $this->handleStateChange('intruder_alarm_state', 'Z2M_IntruderAlarmState', 'Intruder Alarm State', $Payload);
                }
                if (array_key_exists('voc_index', $Payload)) {
                    $this->SetValue('Z2M_VOCIndex', $Payload['voc_index']);
                }
                if (array_key_exists('auto_off', $Payload)) {
                    $this->handleStateChange('auto_off', 'Z2M_AutoOff', 'Auto Off', $Payload);
                }
                if (array_key_exists('schedule_settings', $Payload)) {
                    $this->SetValue('Z2M_ScheduleSettings', $Payload['schedule_settings']);
                }
                if (array_key_exists('schedule', $Payload)) {
                    $this->handleStateChange('schedule', 'Z2M_Schedule', 'Schedule', $Payload);
                }
                if (array_key_exists('valve_alarm', $Payload)) {
                    $this->handleStateChange('valve_alarm', 'Z2M_ValveAlarm', 'Valve Alarm', $Payload);
                }
                if (array_key_exists('setup', $Payload)) {
                    $this->handleStateChange('setup', 'Z2M_Setup', 'Setup', $Payload);
                }
                if (array_key_exists('calibrated', $Payload)) {
                    $this->handleStateChange('calibrated', 'Z2M_Calibration', 'Calibrated', $Payload);
                }
                if (array_key_exists('external_temperature_input', $Payload)) {
                    $this->SetValue('Z2M_ExternalTemperatureInput', $Payload['external_temperature_input']);
                }
                if (array_key_exists('calibrate', $Payload)) {
                    $this->SetValue('Z2M_Calibrate', $Payload['calibrate']);
                }
                if (array_key_exists('voltage_a', $Payload)) {
                    $this->SetValue('Z2M_VoltageA', $Payload['voltage_a']);
                }
                if (array_key_exists('voltage_b', $Payload)) {
                    $this->SetValue('Z2M_VoltageB', $Payload['voltage_b']);
                }
                if (array_key_exists('voltage_c', $Payload)) {
                    $this->SetValue('Z2M_VoltageC', $Payload['voltage_c']);
                }
                if (array_key_exists('voltage_X', $Payload)) {
                    $this->SetValue('Z2M_VoltageX', $Payload['voltage_X']);
                }
                if (array_key_exists('voltage_x', $Payload)) {
                    $this->SetValue('Z2M_VoltageX', $Payload['voltage_x']);
                }
                if (array_key_exists('voltage_Y', $Payload)) {
                    $this->SetValue('Z2M_VoltageY', $Payload['voltage_Y']);
                }
                if (array_key_exists('voltage_y', $Payload)) {
                    $this->SetValue('Z2M_VoltageX', $Payload['voltage_y']);
                }
                if (array_key_exists('voltage_Z', $Payload)) {
                    $this->SetValue('Z2M_VoltageZ', $Payload['voltage_Z']);
                }
                if (array_key_exists('voltage_z', $Payload)) {
                    $this->SetValue('Z2M_VoltageZ', $Payload['voltage_X']);
                }
                if (array_key_exists('power_a', $Payload)) {
                    $this->SetValue('Z2M_PowerA', $Payload['power_a']);
                }
                if (array_key_exists('power_b', $Payload)) {
                    $this->SetValue('Z2M_PowerB', $Payload['power_b']);
                }
                if (array_key_exists('power_c', $Payload)) {
                    $this->SetValue('Z2M_PowerC', $Payload['power_c']);
                }
                if (array_key_exists('power_X', $Payload)) {
                    $this->SetValue('Z2M_PowerX', $Payload['power_X']);
                }
                if (array_key_exists('power_y', $Payload)) {
                    $this->SetValue('Z2M_PowerY', $Payload['power_y']);
                }
                if (array_key_exists('power_Y', $Payload)) {
                    $this->SetValue('Z2M_PowerY', $Payload['power_Y']);
                }
                if (array_key_exists('power_z', $Payload)) {
                    $this->SetValue('Z2M_PowerZ', $Payload['power_z']);
                }
                if (array_key_exists('power_Z', $Payload)) {
                    $this->SetValue('Z2M_PowerZ', $Payload['power_Z']);
                }
                if (array_key_exists('current_a', $Payload)) {
                    $this->SetValue('Z2M_CurrentA', $Payload['current_a']);
                }
                if (array_key_exists('current_b', $Payload)) {
                    $this->SetValue('Z2M_CurrentB', $Payload['current_b']);
                }
                if (array_key_exists('current_c', $Payload)) {
                    $this->SetValue('Z2M_CurrentC', $Payload['current_c']);
                }
                if (array_key_exists('current_X', $Payload)) {
                    $this->SetValue('Z2M_CurrentX', $Payload['current_X']);
                }
                if (array_key_exists('current_x', $Payload)) {
                    $this->SetValue('Z2M_CurrentX', $Payload['current_x']);
                }
                if (array_key_exists('current_y', $Payload)) {
                    $this->SetValue('Z2M_CurrentY', $Payload['current_y']);
                }
                if (array_key_exists('current_Y', $Payload)) {
                    $this->SetValue('Z2M_CurrentY', $Payload['current_Y']);
                }
                if (array_key_exists('current_z', $Payload)) {
                    $this->SetValue('Z2M_CurrentZ', $Payload['current_z']);
                }
                if (array_key_exists('current_Z', $Payload)) {
                    $this->SetValue('Z2M_CurrentZ', $Payload['current_Z']);
                }
                if (array_key_exists('produced_energy', $Payload)) {
                    $this->SetValue('Z2M_ProducedEnergy', $Payload['produced_energy']);
                }
                if (array_key_exists('temperature_periodic_report', $Payload)) {
                    $this->SetValue('Z2M_TemperaturePeriodicReport', $Payload['temperature_periodic_report']);
                }
                if (array_key_exists('humidity_periodic_report', $Payload)) {
                    $this->SetValue('Z2M_HumidityPeriodicReport', $Payload['humidity_periodic_report']);
                }
                if (array_key_exists('temperature_sensitivity', $Payload)) {
                    $this->SetValue('Z2M_TemperatureSensitivity', $Payload['temperature_sensitivity']);
                }
                if (array_key_exists('humidity_sensitivity', $Payload)) {
                    $this->SetValue('Z2M_HumiditySensitivity', $Payload['humidity_sensitivity']);
                }
                if (array_key_exists('alarm_ringtone', $Payload)) {
                    $this->SetValue('Z2M_AlarmRingtone', $Payload['alarm_ringtone']);
                }
                if (array_key_exists('opening_mode', $Payload)) {
                    $this->SetValue('Z2M_OpeningMode', $Payload['opening_mode']);
                }
                if (array_key_exists('set_upper_limit', $Payload)) {
                    $this->SetValue('Z2M_SetUpperLimit', $Payload['set_upper_limit']);
                }
                if (array_key_exists('set_bottom_limit', $Payload)) {
                    $this->SetValue('Z2M_SetBottomLimit', $Payload['set_bottom_limit']);
                }
                if (array_key_exists('temperature_alarm', $Payload)) {
                    $this->SetValue('Z2M_TemperatureAlarm', $Payload['temperature_alarm']);
                }
                if (array_key_exists('humidity_alarm', $Payload)) {
                    $this->SetValue('Z2M_HumidityAlarm', $Payload['humidity_alarm']);
                }
                if (array_key_exists('max_temperature_alarm', $Payload)) {
                    $this->SetValue('Z2M_MaxTemperatureAlarm', $Payload['max_temperature_alarm']);
                }
                if (array_key_exists('min_temperature_alarm', $Payload)) {
                    $this->SetValue('Z2M_MinTemperatureAlarm', $Payload['min_temperature_alarm']);
                }
                if (array_key_exists('max_humidity_alarm', $Payload)) {
                    $this->SetValue('Z2M_MaxHumidityAlarm', $Payload['max_humidity_alarm']);
                }
                if (array_key_exists('min_humidity_alarm', $Payload)) {
                    $this->SetValue('Z2M_MinHumidityAlarm', $Payload['min_humidity_alarm']);
                }
                if (array_key_exists('online', $Payload)) {
                    $this->SetValue('Z2M_Online', $Payload['online']);
                }
                if (array_key_exists('error_status', $Payload)) {
                    $this->SetValue('Z2M_ErrorStatus', $Payload['error_status']);
                }
                if (array_key_exists('working_day', $Payload)) {
                    $this->SetValue('Z2M_WorkingDay', $Payload['working_day']);
                }
                if (array_key_exists('week_day', $Payload)) {
                    $this->SetValue('Z2M_WeekDay', $Payload['week_day']);
                }
                if (array_key_exists('cycle_irrigation_num_times', $Payload)) {
                    $this->SetValue('Z2M_CycleIrrigationNumTimes', $Payload['cycle_irrigation_num_times']);
                }
                if (array_key_exists('irrigation_start_time', $Payload)) {
                    $this->SetValue('Z2M_IrrigationStartTime', $Payload['irrigation_start_time']);
                }
                if (array_key_exists('irrigation_end_time', $Payload)) {
                    $this->SetValue('Z2M_IrrigationEndTime', $Payload['irrigation_end_time']);
                }
                if (array_key_exists('last_irrigation_duration', $Payload)) {
                    $this->SetValue('Z2M_LastIrrigationDuration', $Payload['last_irrigation_duration']);
                }
                if (array_key_exists('water_consumed', $Payload)) {
                    $this->SetValue('Z2M_WaterConsumed', $Payload['water_consumed']);
                }
                if (array_key_exists('irrigation_target', $Payload)) {
                    $this->SetValue('Z2M_IrrigationTarget', $Payload['irrigation_target']);
                }
                if (array_key_exists('cycle_irrigation_interval', $Payload)) {
                    $this->SetValue('Z2M_CycleIrrigationInterval', $Payload['cycle_irrigation_interval']);
                }
                if (array_key_exists('countdown_l1', $Payload)) {
                    $this->SetValue('Z2M_CountdownL1', $Payload['countdown_l1']);
                }
                if (array_key_exists('countdown_l2', $Payload)) {
                    $this->SetValue('Z2M_CountdownL2', $Payload['countdown_l2']);
                }
                if (array_key_exists('presence_timeout', $Payload)) {
                    $this->SetValue('Z2M_Presence_Timeout', $Payload['presence_timeout']);
                }
                if (array_key_exists('radar_range', $Payload)) {
                    $this->SetValue('Z2M_RadarRange', $Payload['radar_range']);
                }
                if (array_key_exists('move_sensitivity', $Payload)) {
                    $this->SetValue('Z2M_MoveSensitivity', $Payload['move_sensitivity']);
                }
                if (array_key_exists('distance', $Payload)) {
                    $this->SetValue('Z2M_Distance', $Payload['distance']);
                }
                if (array_key_exists('power_reactive', $Payload)) {
                    $this->SetValue('Z2M_PowerReactive', $Payload['power_reactive']);
                }
                if (array_key_exists('illuminance_above_threshold', $Payload)) {
                    $this->SetValue('Z2M_IlluminanceAboveThreshold', $Payload['illuminance_above_threshold']);
                }
                if (array_key_exists('requested_brightness_percent', $Payload)) {
                    $this->SetValue('Z2M_RequestedBrightnessPercent', $Payload['requested_brightness_percent']);
                }
                if (array_key_exists('requested_brightness_level', $Payload)) {
                    $this->SetValue('Z2M_RequestedBrightnessLevel', $Payload['requested_brightness_level']);
                }
                if (array_key_exists('x_axis', $Payload)) {
                    $this->SetValue('Z2M_XAxis', $Payload['x_axis']);
                }
                if (array_key_exists('y_axis', $Payload)) {
                    $this->SetValue('Z2M_YAxis', $Payload['y_axis']);
                }
                if (array_key_exists('z_axis', $Payload)) {
                    $this->SetValue('Z2M_ZAxis', $Payload['z_axis']);
                }
                if (array_key_exists('power_factor', $Payload)) {
                    $this->SetValue('Z2M_PowerFactor', $Payload['power_factor']);
                }
                if (array_key_exists('ac_frequency', $Payload)) {
                    $this->SetValue('Z2M_AcFrequency', $Payload['ac_frequency']);
                }
                if (array_key_exists('valve_adapt_process', $Payload)) {
                    $this->SetValue('Z2M_ValveAdaptProcess', $Payload['valve_adapt_process']);
                }
                if (array_key_exists('valve_adapt_status', $Payload)) {
                    $this->SetValue('Z2M_ValveAdaptStatus', $Payload['valve_adapt_status']);
                }
                if (array_key_exists('indicator', $Payload)) {
                    $this->handleStateChange('indicator', 'Z2M_Indicator', 'Indicator', $Payload);
                }
                if (array_key_exists('small_detection_sensitivity', $Payload)) {
                    $this->SetValue('Z2M_SmallDetectionSensitivity', $Payload['small_detection_sensitivity']);
                }
                if (array_key_exists('small_detection_distance', $Payload)) {
                    $this->SetValue('Z2M_SmallDetectionDistance', $Payload['small_detection_distance']);
                }
                if (array_key_exists('medium_motion_detection_distance', $Payload)) {
                    $this->SetValue('Z2M_MediumMotionDetectionDistance', $Payload['medium_motion_detection_distance']);
                }
                if (array_key_exists('medium_motion_detection_sensitivity', $Payload)) {
                    $this->SetValue('Z2M_MediumMotionDetectionSensitivity', $Payload['medium_motion_detection_sensitivity']);
                }
                if (array_key_exists('large_motion_detection_distance', $Payload)) {
                    $this->SetValue('Z2M_LargeMotionDetectionDistance', $Payload['large_motion_detection_distance']);
                }
                if (array_key_exists('large_motion_detection_sensitivity', $Payload)) {
                    $this->SetValue('Z2M_LargeMotionDetectionSensitivity', $Payload['large_motion_detection_sensitivity']);
                }
                if (array_key_exists('motion_state', $Payload)) {
                    $this->SetValue('Z2M_MotionState', $Payload['motion_state']);
                }
                if (array_key_exists('detection_distance', $Payload)) {
                    $this->SetValue('Z2M_DetectionDistance', $Payload['detection_distance']);
                }
                if (array_key_exists('transmit_power', $Payload)) {
                    $this->SetValue('Z2M_TransmitPower', $Payload['transmit_power']);
                }
                if (array_key_exists('presence_sensitivity', $Payload)) {
                    $this->SetValue('Z2M_PresenceSensitivity', $Payload['presence_sensitivity']);
                }
                if (array_key_exists('detection_distance_min', $Payload)) {
                    $this->SetValue('Z2M_DetectionDistanceMin', $Payload['detection_distance_min']);
                }
                if (array_key_exists('detection_distance_max', $Payload)) {
                    $this->SetValue('Z2M_DetectionDistanceMax', $Payload['detection_distance_max']);
                }
                if (array_key_exists('presence_state', $Payload)) {
                    $this->SetValue('Z2M_PresenceState', $Payload['presence_state']);
                }
                if (array_key_exists('self_test_result', $Payload)) {
                    $this->SetValue('Z2M_SelfTestResult', $Payload['self_test_result']);
                }
                if (array_key_exists('presence_event', $Payload)) {
                    $this->SetValue('Z2M_PresenceEvent', $Payload['presence_event']);
                }
                if (array_key_exists('action_zone', $Payload)) {
                    $this->SetValue('Z2M_ActionZone', $Payload['action_zone']);
                }
                if (array_key_exists('device_mode', $Payload)) {
                    $this->SetValue('Z2M_DeviceMode', $Payload['device_mode']);
                }
                if (array_key_exists('monitoring_mode', $Payload)) {
                    $this->SetValue('Z2M_MonitoringMode', $Payload['monitoring_mode']);
                }
                if (array_key_exists('approach_distance', $Payload)) {
                    $this->SetValue('Z2M_ApproachDistance', $Payload['approach_distance']);
                }
                if (array_key_exists('reset_nopresence_status', $Payload)) {
                    $this->SetValue('Z2M_ResetNopresenceStatus', $Payload['reset_nopresence_status']);
                }
                if (array_key_exists('scale_protection', $Payload)) {
                    $this->handleStateChange('scale_protection', 'Z2M_ScaleProtection', 'Scale Protection', $Payload);
                }
                if (array_key_exists('led_indication', $Payload)) {
                    $this->handleStateChange('led_indication', 'Z2M_LEDIndication', 'LED Indication', $Payload);
                }
                if (array_key_exists('silence', $Payload)) {
                    $this->SetValue('Z2M_Silence', $Payload['silence']);
                }
                if (array_key_exists('learn_ir_code', $Payload)) {
                    $this->handleStateChange('learn_ir_caode', 'Z2M_LearnIRCode', 'Learn IR Code', $Payload);
                }
                if (array_key_exists('error', $Payload)) {
                    $this->SetValue('Z2M_TRVError', $Payload['error']);
                }
                if (array_key_exists('learned_ir_code', $Payload)) {
                    $this->SetValue('Z2M_LearnedIRCode', $Payload['learned_ir_code']);
                }
                if (array_key_exists('fan_mode', $Payload)) {
                    $this->SetValue('Z2M_FanMode', $Payload['fan_mode']);
                }
                if (array_key_exists('alarm_time', $Payload)) {
                    $this->SetValue('Z2M_AlarmTime', $Payload['alarm_time']);
                }
                if (array_key_exists('alarm_mode', $Payload)) {
                    $this->SetValue('Z2M_AlarmMode', $Payload['alarm_mode']);
                }
                if (array_key_exists('charge_state', $Payload)) {
                    $this->handleStateChange('charge_state', 'Z2M_ChargeState', 'Charge State', $Payload);
                }
                if (array_key_exists('alarm_melody', $Payload)) {
                    $this->SetValue('Z2M_AlarmMelody', $Payload['alarm_melody']);
                }
                if (array_key_exists('tamper_alarm', $Payload)) {
                    $this->handleStateChange('tamper_alarm', 'Z2M_TamperAlarm', 'Tamper Alarm', $Payload);
                }
                if (array_key_exists('tamper_alarm_switch', $Payload)) {
                    $this->handleStateChange('tamper_alarm_switch', 'Z2M_TamperAlarmSwitch', 'Tamper Alarm Switch', $Payload);
                }
                if (array_key_exists('alarm_switch', $Payload)) {
                    $this->handleStateChange('alarm_switch', 'Z2M_AlarmSwitch', 'Alarm Switch', $Payload);
                }
                if (array_key_exists('alarm_state', $Payload)) {
                    $this->SetValue('Z2M_AlarmState', $Payload['alarm_state']);
                }
                if (array_key_exists('do_not_disturb', $Payload)) {
                    $this->SetValue('Z2M_DoNotDisturb', $Payload['do_not_disturb']);
                }
                if (array_key_exists('color_power_on_behavior', $Payload)) {
                    $this->SetValue('Z2M_ColorPowerOnBehavior', $Payload['color_power_on_behavior']);
                }
                if (array_key_exists('displayed_temperature', $Payload)) {
                    $this->SetValue('Z2M_DisplayedTemperature', $Payload['displayed_temperature']);
                }
                if (array_key_exists('remote_temperature', $Payload)) {
                    $this->SetValue('Z2M_RemoteTemperature', $Payload['remote_temperature']);
                }
                if (array_key_exists('co', $Payload)) {
                    $this->SetValue('Z2M_CO', $Payload['co']);
                }
                if (array_key_exists('battery_state', $Payload)) {
                    $this->SetValue('Z2M_BatteryState', $Payload['battery_state']);
                }
                if (array_key_exists('temperature_unit', $Payload)) {
                    $this->SetValue('Z2M_TemperatureUnit', $Payload['temperature_unit']);
                }
                if (array_key_exists('soil_moisture', $Payload)) {
                    $this->SetValue('Z2M_SoilMoisture', $Payload['soil_moisture']);
                }
                if (array_key_exists('mute', $Payload)) {
                    $this->SetValue('Z2M_Mute', $Payload['mute']);
                }
                if (array_key_exists('mute_buzzer', $Payload)) {
                    $this->SetValue('Z2M_MuteBuzzer', $Payload['mute_buzzer']);
                }
                if (array_key_exists('adaptation_run_control', $Payload)) {
                    $this->SetValue('Z2M_AdaptationRunControl', $Payload['adaptation_run_control']);
                }
                if (array_key_exists('adaptation_run_status', $Payload)) {
                    $this->SetValue('Z2M_AdaptationRunStatus', $Payload['adaptation_run_status']);
                }
                if (array_key_exists('day_of_week', $Payload)) {
                    $this->SetValue('Z2M_Day_Of_Week', $Payload['day_of_week']);
                }
                if (array_key_exists('regulation_setpoint_offset', $Payload)) {
                    $this->SetValue('Z2M_RegulationSetpointOffset', $Payload['regulation_setpoint_offset']);
                }
                if (array_key_exists('load_estimate', $Payload)) {
                    $this->SetValue('Z2M_LoadEstimate', $Payload['load_estimate']);
                }
                if (array_key_exists('load_room_mean', $Payload)) {
                    $this->SetValue('Z2M_LoadRoomMean', $Payload['load_room_mean']);
                }
                if (array_key_exists('algorithm_scale_factor', $Payload)) {
                    $this->SetValue('Z2M_AlgorithmScaleFactor', $Payload['algorithm_scale_factor']);
                }
                if (array_key_exists('trigger_time', $Payload)) {
                    $this->SetValue('Z2M_TriggerTime', $Payload['trigger_time']);
                }
                if (array_key_exists('window_open_internal', $Payload)) {
                    $this->SetValue('Z2M_WindowOpenInternal', $Payload['window_open_internal']);
                }
                if (array_key_exists('adaptation_run_settings', $Payload)) {
                    $this->SetValue('Z2M_AdaptationRunSettings', $Payload['adaptation_run_settings']);
                }
                if (array_key_exists('preheat_status', $Payload)) {
                    $this->SetValue('Z2M_PreheatStatus', $Payload['preheat_status']);
                }
                if (array_key_exists('load_balancing_enable', $Payload)) {
                    $this->SetValue('Z2M_LoadBalancingEnable', $Payload['load_balancing_enable']);
                }
                if (array_key_exists('window_open_external', $Payload)) {
                    $this->SetValue('Z2M_WindowOpenExternal', $Payload['window_open_external']);
                }
                if (array_key_exists('window_open_feature', $Payload)) {
                    $this->SetValue('Z2M_WindowOpenFeature', $Payload['window_open_feature']);
                }
                if (array_key_exists('radiator_covered', $Payload)) {
                    $this->SetValue('Z2M_RadiatorCovered', $Payload['radiator_covered']);
                }
                if (array_key_exists('external_measured_room_sensor', $Payload)) {
                    $this->SetValue('Z2M_ExternalMeasuredRoomSensor', $Payload['external_measured_room_sensor']);
                }
                if (array_key_exists('occupied_heating_setpoint_scheduled', $Payload)) {
                    $this->SetValue('Z2M_OccupiedHeatingSetpointScheduled', $Payload['occupied_heating_setpoint_scheduled']);
                }
                if (array_key_exists('setpoint_change_source', $Payload)) {
                    $this->SetValue('Z2M_SetpointChangeSource', $Payload['setpoint_change_source']);
                }
                if (array_key_exists('heat_required', $Payload)) {
                    $this->SetValue('Z2M_HeatRequired', $Payload['heat_required']);
                }
                if (array_key_exists('heat_available', $Payload)) {
                    $this->SetValue('Z2M_HeatAvailable', $Payload['heat_available']);
                }
                if (array_key_exists('viewing_direction', $Payload)) {
                    $this->SetValue('Z2M_ViewingDirection', $Payload['viewing_direction']);
                }
                if (array_key_exists('thermostat_vertical_orientation', $Payload)) {
                    $this->SetValue('Z2M_ThermostatVerticalOrientation', $Payload['thermostat_vertical_orientation']);
                }
                if (array_key_exists('mounted_mode_control', $Payload)) {
                    $this->SetValue('Z2M_MountedModeControl', $Payload['mounted_mode_control']);
                }
                if (array_key_exists('programming_operation_mode', $Payload)) {
                    $this->SetValue('Z2M_ProgrammingOperationMode', $Payload['programming_operation_mode']);
                }
                if (array_key_exists('keypad_lockout', $Payload)) {
                    $this->SetValue('Z2M_KeypadLockout', $Payload['keypad_lockout']);
                }
                if (array_key_exists('linkage_alarm_state', $Payload)) {
                    $this->SetValue('Z2M_LinkageAlarmState', $Payload['linkage_alarm_state']);
                }
                if (array_key_exists('linkage_alarm', $Payload)) {
                    $this->SetValue('Z2M_LinkageAlarm', $Payload['linkage_alarm']);
                }
                if (array_key_exists('heartbeat_indicator', $Payload)) {
                    $this->SetValue('Z2M_HeartbeatIndicator', $Payload['heartbeat_indicator']);
                }
                if (array_key_exists('buzzer_manual_mute', $Payload)) {
                    $this->SetValue('Z2M_BuzzerManualMute', $Payload['buzzer_manual_mute']);
                }
                if (array_key_exists('buzzer_manual_alarm', $Payload)) {
                    $this->SetValue('Z2M_BuzzerManualAlarm', $Payload['buzzer_manual_alarm']);
                }
                if (array_key_exists('buzzer', $Payload)) {
                    $this->SetValue('Z2M_Buzzer', $Payload['buzzer']);
                }
                if (array_key_exists('smoke_density_dbm', $Payload)) {
                    $this->SetValue('Z2M_SmokeDensitiyDBM', $Payload['smoke_density_dbm']);
                }
                if (array_key_exists('display_brightness', $Payload)) {
                    $this->SetValue('Z2M_DisplayBrightness', $Payload['display_brightness']);
                }
                if (array_key_exists('display_ontime', $Payload)) {
                    $this->SetValue('Z2M_DisplayOntime', $Payload['display_ontime']);
                }
                if (array_key_exists('display_orientation', $Payload)) {
                    $this->SetValue('Z2M_DisplayOrientation', $Payload['display_orientation']);
                }
                if (array_key_exists('fan_state', $Payload)) {
                    $this->handleStateChange('fan_state', 'Z2M_FanState', 'Fan State', $Payload);
                }
                if (array_key_exists('boost', $Payload)) {
                    $this->handleStateChange('boost', 'Z2M_Boost', 'Boost', $Payload);
                }
                if (array_key_exists('boost_heating', $Payload)) {
                    $this->handleStateChange('boost_heating', 'Z2M_BoostHeating', 'Boost Heating', $Payload);
                }
                if (array_key_exists('boost_heating_countdown_time_set', $Payload)) {
                    $this->SetValue('Z2M_BoostHeatingCountdownTimeSet', $Payload['boost_heating_countdown_time_set']);
                }
                if (array_key_exists('valve_state', $Payload)) {
                    $this->handleStateChange('valve_state', 'Z2M_ValveState', 'Valve State', $Payload, ['OPEN' => true, 'CLOSED' => false]);
                }
                if (array_key_exists('eco_mode', $Payload)) {
                    $this->handleStateChange('eco_mode', 'Z2M_EcoMode', 'Eco Mode', $Payload);
                }
                if (array_key_exists('side', $Payload)) {
                    $this->SetValue('Z2M_Side', $Payload['side']);
                }
                if (array_key_exists('power_outage_count', $Payload)) {
                    $this->SetValue('Z2M_PowerOutageCount', $Payload['power_outage_count']);
                }
                if (array_key_exists('switch_type', $Payload)) {
                    $this->SetValue('Z2M_SwitchType', $Payload['switch_type']);
                }
                if (array_key_exists('indicator_mode', $Payload)) {
                    $this->SetValue('Z2M_IndicatorMode', $Payload['indicator_mode']);
                }
                if (array_key_exists('temperature_alarm', $Payload)) {
                    $this->SetValue('Z2M_TemperatureAlarm', $Payload['temperature_alarm']);
                }
                if (array_key_exists('humidity_alarm', $Payload)) {
                    $this->SetValue('Z2M_HumidityAlarm', $Payload['humidity_alarm']);
                }
                if (array_key_exists('alarm', $Payload)) {
                    $this->SetValue('Z2M_Alarm', $Payload['alarm']);
                }
                if (array_key_exists('melody', $Payload)) {
                    $this->SetValue('Z2M_Melody', $Payload['melody']);
                }
                if (array_key_exists('power_type', $Payload)) {
                    $this->SetValue('Z2M_PowerType', $Payload['power_type']);
                }
                if (array_key_exists('volume', $Payload)) {
                    $this->SetValue('Z2M_Volume', $Payload['volume']);
                }
                if (array_key_exists('humidity_max', $Payload)) {
                    $this->SetValue('Z2M_HumidityMax', $Payload['humidity_max']);
                }
                if (array_key_exists('humidity_min', $Payload)) {
                    $this->SetValue('Z2M_HumidityMin', $Payload['humidity_min']);
                }
                if (array_key_exists('temperature_max', $Payload)) {
                    $this->SetValue('Z2M_TemperatureMax', $Payload['temperature_max']);
                }
                if (array_key_exists('temperature_min', $Payload)) {
                    $this->SetValue('Z2M_TemperatureMin', $Payload['temperature_min']);
                }
                if (array_key_exists('backlight_mode', $Payload)) {
                    if (in_array($Payload['backlight_mode'], ['ON', 'OFF'])) {
                        $this->handleStateChange('backlight_mode', 'Z2M_BacklightMode', 'backlight mode', $Payload);
                    } elseif (in_array($Payload['backlight_mode'], ['low', 'high'])) {
                        $this->SetValue('Z2M_BacklightMode', $Payload['backlight_mode']);
                    } else {
                        $this->SendDebug('backlight mode', 'Undefined State: ' . $Payload['backlight_mode'], 0);
                    }
                }
                if (array_key_exists('self_test', $Payload)) {
                    $this->SetValue('Z2M_SelfTest', $Payload['self_test']);
                }
                if (array_key_exists('preheat', $Payload)) {
                    $this->SetValue('Z2M_Preheat', $Payload['preheat']);
                }
                if (array_key_exists('led_state', $Payload)) {
                    $this->SetValue('Z2M_LedState', $Payload['led_state']);
                }
                if (array_key_exists('duration_of_absence', $Payload)) {
                    $this->SetValue('Z2M_Absence', $Payload['duration_of_absence']);
                }
                if (array_key_exists('duration_of_attendance', $Payload)) {
                    $this->SetValue('Z2M_Attendance', $Payload['duration_of_attendance']);
                }
                if (array_key_exists('action_rate', $Payload)) {
                    $this->RegisterVariableInteger('Z2M_ActionRate', $this->Translate('Action Rate'), $ProfileName);
                    $this->EnableAction('Z2M_ActionRate');
                    $this->SetValue('Z2M_ActionRate', $Payload['action_rate']);
                }
                if (array_key_exists('action_level', $Payload)) {
                    $this->RegisterVariableInteger('Z2M_ActionLevel', $this->Translate('Action Level'), $ProfileName);
                    $this->EnableAction('Z2M_ActionLevel');
                    $this->SetValue('Z2M_ActionLevel', $Payload['action_level']);
                }
                if (array_key_exists('action_step_size', $Payload)) {
                    $this->SetValue('Z2M_ActionStepSize', $Payload['action_step_size']);
                }
                if (array_key_exists('action_transition_time', $Payload)) {
                    $this->RegisterVariableInteger('Z2M_ActionTransTime', $this->Translate('Action Transition Time'), $ProfileName);
                    $this->EnableAction('Z2M_ActionTransTime');
                    $this->SetValue('Z2M_ActionTransTime', $Payload['action_transition_time']);
                }
                if (array_key_exists('action_group', $Payload)) {
                    $this->SetValue('Z2M_ActionGroup', $Payload['action_group']);
                }
                if (array_key_exists('action_color_temperature', $Payload)) {
                    $this->SetValue('Z2M_ActionColorTemp', $Payload['action_color_temperature']);
                }
                if (array_key_exists('temperature', $Payload)) {
                    $this->SetValue('Z2M_Temperature', $Payload['temperature']);
                }
                if (array_key_exists('temperature_l1', $Payload)) {
                    $this->SetValue('Z2M_TemperatureL1', $Payload['temperature_l1']);
                }
                if (array_key_exists('temperature_l2', $Payload)) {
                    $this->SetValue('Z2M_TemperatureL2', $Payload['temperature_l2']);
                }
                if (array_key_exists('temperature_l3', $Payload)) {
                    $this->SetValue('Z2M_TemperatureL3', $Payload['temperature_l3']);
                }
                if (array_key_exists('temperature_l4', $Payload)) {
                    $this->SetValue('Z2M_TemperatureL4', $Payload['temperature_l4']);
                }
                if (array_key_exists('temperature_l5', $Payload)) {
                    $this->SetValue('Z2M_TemperatureL5', $Payload['temperature_l5']);
                }
                if (array_key_exists('temperature_l6', $Payload)) {
                    $this->SetValue('Z2M_TemperatureL6', $Payload['temperature_l6']);
                }
                if (array_key_exists('temperature_l7', $Payload)) {
                    $this->SetValue('Z2M_TemperatureL7', $Payload['temperature_l7']);
                }
                if (array_key_exists('temperature_l8', $Payload)) {
                    $this->SetValue('Z2M_TemperatureL8', $Payload['temperature_l8']);
                }
                if (array_key_exists('device_temperature', $Payload)) {
                    $this->SetValue('Z2M_DeviceTemperature', $Payload['device_temperature']);
                }
                if (array_key_exists('local_temperature', $Payload)) {
                    $this->SetValue('Z2M_LocalTemperature', $Payload['local_temperature']);
                }
                if (array_key_exists('local_temperature_calibration', $Payload)) {
                    $this->SetValue('Z2M_LocalTemperatureCalibration', $Payload['local_temperature_calibration']);
                }
                if (array_key_exists('max_temperature', $Payload)) {
                    $this->SetValue('Z2M_MaxTemperature', $Payload['max_temperature']);
                }
                if (array_key_exists('min_temperature', $Payload)) {
                    $this->SetValue('Z2M_MinTemperature', $Payload['min_temperature']);
                }
                if (array_key_exists('eco_temperature', $Payload)) {
                    $this->SetValue('Z2M_EcoTemperature', $Payload['eco_temperature']);
                }
                if (array_key_exists('preset', $Payload)) {
                    $this->SetValue('Z2M_Preset', $Payload['preset']);
                }
                if (array_key_exists('away_mode', $Payload)) {
                    $this->handleStateChange('away_mode', 'Z2M_AwayMode', 'Away Mode', $Payload);
                }
                if (array_key_exists('away_preset_days', $Payload)) {
                    $this->SetValue('Z2M_AwayPresetDays', $Payload['away_preset_days']);
                }
                if (array_key_exists('away_preset_temperature', $Payload)) {
                    $this->SetValue('Z2M_AwayPresetTemperature', $Payload['away_preset_temperature']);
                }
                if (array_key_exists('boost_time', $Payload)) {
                    $this->SetValue('Z2M_BoostTime', $Payload['boost_time']);
                }
                if (array_key_exists('comfort_temperature', $Payload)) {
                    $this->SetValue('Z2M_ComfortTemperature', $Payload['comfort_temperature']);
                }
                if (array_key_exists('eco_temperature', $Payload)) {
                    $this->SetValue('Z2M_EcoTemperature', $Payload['eco_temperature']);
                }
                if (array_key_exists('current_heating_setpoint', $Payload)) {
                    $this->SetValue('Z2M_CurrentHeatingSetpoint', $Payload['current_heating_setpoint']);
                }
                if (array_key_exists('current_heating_setpoint_auto', $Payload)) {
                    $this->SetValue('Z2M_CurrentHeatingSetpoint', $Payload['current_heating_setpoint_auto']);
                }
                if (array_key_exists('occupied_heating_setpoint', $Payload)) {
                    $this->SetValue('Z2M_OccupiedHeatingSetpoint', $Payload['occupied_heating_setpoint']);
                }
                if (array_key_exists('pi_heating_demand', $Payload)) {
                    $this->SetValue('Z2M_PiHeatingDemand', $Payload['pi_heating_demand']);
                }
                if (array_key_exists('system_mode', $Payload)) {
                    $this->SetValue('Z2M_SystemMode', $Payload['system_mode']);
                }
                if (array_key_exists('running_state', $Payload)) {
                    $this->SetValue('Z2M_RunningState', $Payload['running_state']);
                }
                if (array_key_exists('sensor', $Payload)) {
                    $this->SetValue('Z2M_Sensor', $Payload['sensor']);
                }
                if (array_key_exists('linkquality', $Payload)) {
                    $this->SetValue('Z2M_Linkquality', $Payload['linkquality']);
                }
                if (array_key_exists('valve_position', $Payload)) {
                    $this->SetValue('Z2M_ValvePosition', $Payload['valve_position']);
                }
                if (array_key_exists('humidity', $Payload)) {
                    $this->SetValue('Z2M_Humidity', $Payload['humidity']);
                }
                if (array_key_exists('pressure', $Payload)) {
                    $this->SetValue('Z2M_Pressure', $Payload['pressure']);
                }
                if (array_key_exists('battery', $Payload)) {
                    $this->SetValue('Z2M_Battery', $Payload['battery']);
                }
                //Da Millivolt und Volt mit dem selben Topic verschickt wird
                if (array_key_exists('voltage', $Payload)) {
                    if ($Payload['voltage'] > 400) { //Es gibt wahrscheinlich keine Zigbee Geräte mit über 400 Volt
                        $this->SetValue('Z2M_Voltage', $Payload['voltage'] / 1000);
                    } else {
                        $this->SetValue('Z2M_Voltage', $Payload['voltage']);
                    }
                }
                if (array_key_exists('current', $Payload)) {
                    $this->SetValue('Z2M_Current', $Payload['current']);
                }
                if (array_key_exists('action', $Payload)) {
                    $this->SetValue('Z2M_Action', $Payload['action']);
                }
                if (array_key_exists('min_brightness_l1', $Payload)) {
                    $this->SetValue('Z2M_MinBrightnessL1', $Payload['min_brightness_l1']);
                }
                if (array_key_exists('Maxbrightness_l1', $Payload)) {
                    $this->SetValue('Z2M_MaxBrightnessL1', $Payload['max_brightness_l1']);
                }
                if (array_key_exists('min_brightness_l2', $Payload)) {
                    $this->SetValue('Z2M_MinBrightnessL2', $Payload['min_brightness_l2']);
                }
                if (array_key_exists('Maxbrightness_l2', $Payload)) {
                    $this->SetValue('Z2M_MaxBrightnessL2', $Payload['max_brightness_l2']);
                }
                if (array_key_exists('brightness', $Payload)) {
                    $this->SetValue('Z2M_Brightness', $Payload['brightness']);
                }
                if (array_key_exists('brightness_l1', $Payload)) {
                    $this->SetValue('Z2M_BrightnessL1', $Payload['brightness_l1']);
                }
                if (array_key_exists('brightness_l2', $Payload)) {
                    $this->SetValue('Z2M_BrightnessL2', $Payload['brightness_l2']);
                }
                if (array_key_exists('brightness_rgb', $Payload)) {
                    $this->EnableAction('Z2M_BrightnessRGB');
                    $this->SetValue('Z2M_BrightnessRGB', $Payload['brightness_rgb']);
                }
                if (array_key_exists('brightness_cct', $Payload)) {
                    $this->EnableAction('Z2M_BrightnessCCT');
                    $this->SetValue('Z2M_BrightnessCCT', $Payload['brightness_CCT']);
                }
                if (array_key_exists('brightness_white', $Payload)) {
                    $this->SetValue('Z2M_BrightnessWhite', $Payload['brightness_white']);
                }
                if (array_key_exists('position', $Payload)) {
                    $this->SetValue('Z2M_Position', $Payload['position']);
                }
                if (array_key_exists('position_left', $Payload)) {
                    $this->SetValue('Z2M_PositionLeft', $Payload['position_left']);
                }
                if (array_key_exists('position_right', $Payload)) {
                    $this->SetValue('Z2M_PositionRight', $Payload['position_right']);
                }
                if (array_key_exists('motor_speed', $Payload)) {
                    $this->SetValue('Z2M_MotorSpeed', $Payload['motor_speed']);
                }
                if (array_key_exists('region_id', $Payload)) {
                    $this->SetValue('Z2M_RegionID', $Payload['region_id']);
                }
                if (array_key_exists('occupancy', $Payload)) {
                    $this->SetValue('Z2M_Occupancy', $Payload['occupancy']);
                }
                if (array_key_exists('occupancy_timeout', $Payload)) {
                    $this->SetValue('Z2M_OccupancyTimeout', $Payload['occupancy_timeout']);
                }
                if (array_key_exists('motion_sensitivity', $Payload)) {
                    $this->SetValue('Z2M_MotionSensitivity', $Payload['motion_sensitivity']);
                }
                if (array_key_exists('presence', $Payload)) {
                    $this->SetValue('Z2M_Presence', $Payload['presence']);
                }
                if (array_key_exists('motion', $Payload)) {
                    $this->SetValue('Z2M_Motion', $Payload['motion']);
                }
                if (array_key_exists('motion_direction', $Payload)) {
                    $this->SetValue('Z2M_MotionDirection', $Payload['motion_direction']);
                }
                if (array_key_exists('motor_direction', $Payload)) {
                    $this->SetValue('Z2M_MotorDirection', $Payload['motor_direction']);
                }
                if (array_key_exists('scene', $Payload)) {
                    $this->LogMessage('Please contact module developer. Undefined variable: scene', KL_WARNING);
                    //$this->RegisterVariableString('Z2M_Scene', $this->Translate('Scene'), '');
                    //$this->SetValue('Z2M_Scene', $Payload['scene']);
                }
                if (array_key_exists('motion_speed', $Payload)) {
                    $this->SetValue('Z2M_MotionSpeed', $Payload['motion_speed']);
                }
                if (array_key_exists('led_enable', $Payload)) {
                    $this->SetValue('Z2M_LEDEnable', $Payload['led_enable']);
                }
                if (array_key_exists('replace_filter', $Payload)) {
                    $this->SetValue('Z2M_ReplaceFilter', $Payload['replace_filter']);
                }
                if (array_key_exists('filter_age', $Payload)) {
                    $this->SetValue('Z2M_FilterAge', $Payload['filter_age']);
                }
                if (array_key_exists('fan_speed', $Payload)) {
                    $this->SetValue('Z2M_FanSpeed', $Payload['fan_speed']);
                }
                if (array_key_exists('air_quality', $Payload)) {
                    $this->SetValue('Z2M_AirQuality', $Payload['air_quality']);
                }
                if (array_key_exists('radar_sensitivity', $Payload)) {
                    $this->SetValue('Z2M_RadarSensitivity', $Payload['radar_sensitivity']);
                }
                if (array_key_exists('radar_scene', $Payload)) {
                    $this->SetValue('Z2M_RadarScene', $Payload['radar_scene']);
                }
                if (array_key_exists('motor_working_mode', $Payload)) {
                    $this->SetValue('Z2M_MotorWorkingMode', $Payload['motor_working_mode']);
                }
                if (array_key_exists('detection_interval', $Payload)) {
                    $this->SetValue('Z2M_DetectionInterval', $Payload['detection_interval']);
                }
                if (array_key_exists('control', $Payload)) {
                    $this->SetValue('Z2M_Control', $Payload['control']);
                }
                if (array_key_exists('mode', $Payload)) {
                    $this->SetValue('Z2M_Mode', $Payload['mode']);
                }
                if (array_key_exists('week', $Payload)) {
                    $this->SetValue('Z2M_Week', $Payload['week']);
                }
                if (array_key_exists('control_back_mode', $Payload)) {
                    $this->SetValue('Z2M_ControlBackMode', $Payload['control_back_mode']);
                }
                if (array_key_exists('border', $Payload)) {
                    $this->SetValue('Z2M_Border', $Payload['border']);
                }
                if (array_key_exists('illuminance', $Payload)) {
                    $this->SetValue('Z2M_Illuminance', $Payload['illuminance']);
                }
                if (array_key_exists('illuminance_lux', $Payload)) {
                    if (@$this->GetIDForIdent('Z2M_Illuminance_Lux') > 0) {
                        $this->SetValue('Z2M_Illuminance_Lux', $Payload['illuminance_lux']);
                    }
                }
                if (array_key_exists('illuminance_lux_l1', $Payload)) {
                    if (@$this->GetIDForIdent('Z2M_Illuminance_Lux_l1') > 0) {
                        $this->SetValue('Z2M_Illuminance_Lux_l1', $Payload['illuminance_lux_l1']);
                    }
                }
                if (array_key_exists('illuminance_lux_l2', $Payload)) {
                    if (@$this->GetIDForIdent('Z2M_Illuminance_Lux_l2') > 0) {
                        $this->SetValue('Z2M_Illuminance_Lux_l2', $Payload['illuminance_lux_l2']);
                    }
                }
                if (array_key_exists('illuminance_lux_l3', $Payload)) {
                    if (@$this->GetIDForIdent('Z2M_Illuminance_Lux_l3') > 0) {
                        $this->SetValue('Z2M_Illuminance_Lux_l3', $Payload['illuminance_lux_l3']);
                    }
                }
                if (array_key_exists('illuminance_lux_l4', $Payload)) {
                    if (@$this->GetIDForIdent('Z2M_Illuminance_Lux_l4') > 0) {
                        $this->SetValue('Z2M_Illuminance_Lux_l4', $Payload['illuminance_lux_l4']);
                    }
                }
                if (array_key_exists('illuminance_lux_l5', $Payload)) {
                    if (@$this->GetIDForIdent('Z2M_Illuminance_Lux_l5') > 0) {
                        $this->SetValue('Z2M_Illuminance_Lux_l5', $Payload['illuminance_lux_l5']);
                    }
                }
                if (array_key_exists('illuminance_lux_l6', $Payload)) {
                    if (@$this->GetIDForIdent('Z2M_Illuminance_Lux_l6') > 0) {
                        $this->SetValue('Z2M_Illuminance_Lux_l6', $Payload['illuminance_lux_l6']);
                    }
                }
                if (array_key_exists('illuminance_lux_l7', $Payload)) {
                    if (@$this->GetIDForIdent('Z2M_Illuminance_Lux_l7') > 0) {
                        $this->SetValue('Z2M_Illuminance_Lux_l7', $Payload['illuminance_lux_l7']);
                    }
                }
                if (array_key_exists('illuminance_lux_l8', $Payload)) {
                    if (@$this->GetIDForIdent('Z2M_Illuminance_Lux_l8') > 0) {
                        $this->SetValue('Z2M_Illuminance_Lux_l8', $Payload['illuminance_lux_l8']);
                    }
                }
                if (array_key_exists('strength', $Payload)) {
                    $this->SetValue('Z2M_Strength', $Payload['strength']);
                }
                if (array_key_exists('water_leak', $Payload)) {
                    $this->SetValue('Z2M_WaterLeak', $Payload['water_leak']);
                }
                if (array_key_exists('contact', $Payload)) {
                    $this->SetValue('Z2M_Contact', $Payload['contact']);
                }
                if (array_key_exists('carbon_monoxide', $Payload)) {
                    $this->SetValue('Z2M_CarbonMonoxide', $Payload['carbon_monoxide']);
                }
                if (array_key_exists('smoke', $Payload)) {
                    $this->SetValue('Z2M_Smoke', $Payload['smoke']);
                }
                if (array_key_exists('smoke_density', $Payload)) {
                    $this->SetValue('Z2M_SmokeDensity', $Payload['smoke_density']);
                }
                if (array_key_exists('tamper', $Payload)) {
                    $this->SetValue('Z2M_Tamper', $Payload['tamper']);
                }
                if (array_key_exists('battery_low', $Payload)) {
                    $this->SetValue('Z2M_Battery_Low', $Payload['battery_low']);
                }
                if (array_key_exists('action_angle', $Payload)) {
                    $this->SetValue('Z2M_ActionAngle', $Payload['action_angle']);
                }
                if (array_key_exists('angle_x', $Payload)) {
                    $this->SetValue('Z2M_Angle_X', $Payload['angle_x']);
                }
                if (array_key_exists('angle_y', $Payload)) {
                    $this->SetValue('Z2M_Angle_Y', $Payload['angle_y']);
                }
                if (array_key_exists('angle_x_absolute', $Payload)) {
                    //$this->LogMessage('Please Contact Module Developer. Undefined Variable angle_x_absolute', KL_WARNING);
                    //$this->RegisterVariableFloat('Z2M_Angle_X_Absolute', $this->Translate('Angle_X_Absolute'), '');
                    $this->SetValue('Z2M_AngleXAbsolute', $Payload['angle_x_absolute']);
                }
                if (array_key_exists('angle_y_absolute', $Payload)) {
                    //$this->LogMessage('Please contact module developer. Undefined variable: angle_y_absolute', KL_WARNING);
                    //$this->RegisterVariableFloat('Z2M_Angle_Y_Absolute', $this->Translate('Angle_Y_Absolute'), '');
                    $this->SetValue('Z2M_AngleYAbsolute', $Payload['angle_y_absolute']);
                }
                if (array_key_exists('angle_z', $Payload)) {
                    $this->SetValue('Z2M_Angle_Z', $Payload['angle_z']);
                }
                if (array_key_exists('action_from_side', $Payload)) {
                    $this->SetValue('Z2M_ActionFromSide', $Payload['action_from_side']);
                }
                if (array_key_exists('action_side', $Payload)) {
                    $this->SetValue('Z2M_ActionSide', $Payload['action_side']);
                }
                if (array_key_exists('action_to_side', $Payload)) {
                    $this->SetValue('Z2M_ActionToSide', $Payload['action_to_side']);
                }
                if (array_key_exists('power', $Payload)) {
                    $this->SetValue('Z2M_Power', $Payload['power']);
                }
                if (array_key_exists('consumer_connected', $Payload)) {
                    $this->SetValue('Z2M_Consumer_Connected', $Payload['consumer_connected']);
                }
                if (array_key_exists('energy', $Payload)) {
                    $this->SetValue('Z2M_Energy', $Payload['energy']);
                }
                if (array_key_exists('overload_protection', $Payload)) {
                    $this->SetValue('Z2M_OverloadProtection', $Payload['overload_protection']);
                }
                if (array_key_exists('duration', $Payload)) {
                    $this->SetValue('Z2M_Duration', $Payload['duration']);
                }
                if (array_key_exists('gas_value', $Payload)) {
                    $this->SetValue('Z2M_GasValue', $Payload['gas_value']);
                }
                if (array_key_exists('gas', $Payload)) {
                    $this->SetValue('Z2M_Gas', $Payload['gas']);
                }
                if (array_key_exists('action_duration', $Payload)) {
                    $this->SetValue('Z2M_ActionDuration', $Payload['action_duration']);
                }
                if (array_key_exists('percent_state', $Payload)) {
                    $this->SetValue('Z2M_PercentState', $Payload['percent_state']);
                }
                if (array_key_exists('color', $Payload)) {
                    if (array_key_exists('x', $Payload['color'])) {
                        $this->SendDebug(__FUNCTION__ . ' Color', $Payload['color']['x'], 0);
                        if (array_key_exists('brightness', $Payload)) {
                            $RGBColor = ltrim($this->xyToHEX($Payload['color']['x'], $Payload['color']['y'], $Payload['brightness']), '#');
                        } else {
                            $RGBColor = ltrim($this->xyToHEX($Payload['color']['x'], $Payload['color']['y'], 255), '#');
                        }
                        $this->SendDebug(__FUNCTION__ . ' Color RGB HEX', $RGBColor, 0);
                        $this->SetValue('Z2M_Color', hexdec(($RGBColor)));
                    } elseif (array_key_exists('hue', $Payload['color']) && array_key_exists('saturation', $Payload['color'])) {
                        $RGBColor = ltrim($this->HSToRGB($Payload['color']['hue'], $Payload['color']['saturation'], 255), '#');
                        $this->SendDebug(__FUNCTION__ . ' Color RGB HEX', $RGBColor, 0);
                        $this->SetValue('Z2M_ColorHS', hexdec($RGBColor));
                    }
                }
                if (array_key_exists('color_rgb', $Payload)) {
                    $this->SendDebug(__FUNCTION__ . ':: Color X', $Payload['color_rgb']['x'], 0);
                    $this->SendDebug(__FUNCTION__ . ':: Color Y', $Payload['color_rgb']['y'], 0);
                    if (array_key_exists('brightness_rgb', $Payload)) {
                        $RGBColor = ltrim($this->xyToHEX($Payload['color_rgb']['x'], $Payload['color_rgb']['y'], $Payload['brightness_rgb']), '#');
                    } else {
                        $RGBColor = ltrim($this->xyToHEX($Payload['color_rgb']['x'], $Payload['color_rgb']['y']), '#');
                    }
                    $this->SendDebug(__FUNCTION__ . ' Color :: RGB HEX', $RGBColor, 0);
                    $this->SetValue('Z2M_ColorRGB', hexdec(($RGBColor)));
                }
                if (array_key_exists('sensitivity', $Payload)) {
                    $this->SetValue('Z2M_Sensitivity', $Payload['sensitivity']);
                    $this->EnableAction('Z2M_Sensitivity');
                }
                if (array_key_exists('color_temp', $Payload)) {
                    $this->SetValue('Z2M_ColorTemp', $Payload['color_temp']);
                    //Color Temperature in Kelvin
                    if ($Payload['color_temp'] > 0) {
                        $this->SetValue('Z2M_ColorTempKelvin', 1000000 / $Payload['color_temp']); //Convert to Kelvin
                    }
                }
                if (array_key_exists('color_temp_rgb', $Payload)) {
                    $this->SetValue('Z2M_ColorTempRGB', $Payload['color_temp_rgb']);
                    if ($Payload['color_temp_rgb'] > 0) {
                        $this->SetValue('Z2M_ColorTempRGBKelvin', 1000000 / $Payload['color_temp_rgb']); //Convert to Kelvin
                    }
                }
                if (array_key_exists('color_temp_cct', $Payload)) {
                    $this->SetValue('Z2M_ColorTempCCT', $Payload['color_temp_cct']);
                    if ($Payload['color_temp_cct'] > 0) {
                        $this->SetValue('Z2M_ColorTempCCTKelvin', 1000000 / $Payload['color_temp_cct']); //Convert to Kelvin
                    }
                }
                if (array_key_exists('color_temp_startup_rgb', $Payload)) {
                    $this->SetValue('Z2M_ColorTempStartupRGB', $Payload['color_temp_startup_rgb']);
                    $this->EnableAction('Z2M_ColorTempStartupRGB');
                }
                if (array_key_exists('color_temp_startup_cct', $Payload)) {
                    $this->SetValue('Z2M_ColorTempStartupCCT', $Payload['color_temp_startup_cct']);
                    $this->EnableAction('Z2M_ColorTempStartupCCT');
                }
                if (array_key_exists('color_temp_startup', $Payload)) {
                    $this->SetValue('Z2M_ColorTempStartup', $Payload['color_temp_startup']);
                    $this->EnableAction('Z2M_ColorTempStartup');
                }
                if (array_key_exists('state', $Payload)) {
                    if (in_array($Payload['state'], ['ON', 'OFF'])) {
                        $this->handleStateChange('state', 'Z2M_State', 'State', $Payload, );
                    } elseif (in_array($Payload['state'], ['OPEN', 'CLOSE', 'STOP', 'move', 'presence', 'none'])) {
                        $this->SetValue('Z2M_State', $Payload['state']);
                    } else {
                        $this->SendDebug('State', 'Undefined State: ' . $Payload['state'], 0);
                    }
                }
                if (array_key_exists('led_disabled_night', $Payload)) {
                    $this->SetValue('Z2M_LEDDisabledNight', $Payload['led_disabled_night']);
                }
                if (array_key_exists('state_rgb', $Payload)) {
                    $this->handleStateChange('state_rgb', 'Z2M_StateRGB', 'State_rgb', $Payload, );
                    $this->EnableAction('Z2M_StateRGB');
                }
                if (array_key_exists('state_cct', $Payload)) {
                    $this->handleStateChange('state_cct', 'Z2M_StateCCT', 'State_cct', $Payload, );
                    $this->EnableAction('Z2M_StateCCT');
                }
                if (array_key_exists('state_white', $Payload)) {
                    $this->handleStateChange('state_white', 'Z2M_StateWhite', 'State White', $Payload);
                }
                if (array_key_exists('power_outage_memory', $Payload)) {
                    $this->SetValue('Z2M_PowerOutageMemory', $Payload['power_outage_memory']);
                }
                if (array_key_exists('power_on_behavior', $Payload)) {
                    $this->SetValue('Z2M_PowerOnBehavior', $Payload['power_on_behavior']);
                }
                if (array_key_exists('power_on_behavior_l1', $Payload)) {
                    $this->SetValue('Z2M_PowerOnBehaviorL1', $Payload['power_on_behavior_l1']);
                }
                if (array_key_exists('power_on_behavior_l2', $Payload)) {
                    $this->SetValue('Z2M_PowerOnBehaviorL2', $Payload['power_on_behavior_l2']);
                }
                if (array_key_exists('power_on_behavior_l3', $Payload)) {
                    $this->SetValue('Z2M_PowerOnBehaviorL3', $Payload['power_on_behavior_l3']);
                }
                if (array_key_exists('power_on_behavior_l4', $Payload)) {
                    $this->SetValue('Z2M_PowerOnBehaviorL4', $Payload['power_on_behavior_l4']);
                }
                if (array_key_exists('state_l1', $Payload)) {
                    $this->handleStateChange('state_l1', 'Z2M_Statel1', 'State 1', $Payload);
                }
                if (array_key_exists('state_l2', $Payload)) {
                    $this->handleStateChange('state_l2', 'Z2M_Statel2', 'State 2', $Payload);
                }
                if (array_key_exists('state_l3', $Payload)) {
                    $this->handleStateChange('state_l3', 'Z2M_Statel3', 'State 3', $Payload);
                }
                if (array_key_exists('state_l4', $Payload)) {
                    $this->handleStateChange('state_l4', 'Z2M_Statel4', 'State 4', $Payload);
                }
                if (array_key_exists('state_l5', $Payload)) {
                    $this->handleStateChange('state_l5', 'Z2M_Statel5', 'State 5', $Payload);
                }
                if (array_key_exists('state_l6', $Payload)) {
                    $this->handleStateChange('state_l6', 'Z2M_Statel6', 'State 6', $Payload);
                }
                if (array_key_exists('state_l7', $Payload)) {
                    $this->handleStateChange('state_l7', 'Z2M_Statel7', 'State 7', $Payload);
                }
                if (array_key_exists('state_l8', $Payload)) {
                    $this->handleStateChange('state_l8', 'Z2M_Statel8', 'State 8', $Payload);
                }
                if (array_key_exists('state_left', $Payload)) {
                    if (in_array($Payload['state_left'], ['ON', 'OFF'])) {
                        $this->handleStateChange('state_left', 'Z2M_state_left', 'State left', $Payload);
                    } elseif (in_array($Payload['state_left'], ['OPEN', 'CLOSE', 'STOP'])) {
                        $this->SetValue('Z2M_state_left', $Payload['state_left']);
                    } else {
                        $this->SendDebug('State left', 'Undefined State: ' . $Payload['state_left'], 0);
                    }
                }
                if (array_key_exists('state_right', $Payload)) {
                    if (in_array($Payload['state_right'], ['ON', 'OFF'])) {
                        $this->handleStateChange('state_right', 'Z2M_state_right', 'State Right', $Payload);
                    } elseif (in_array($Payload['state_right'], ['OPEN', 'CLOSE', 'STOP'])) {
                        $this->SetValue('Z2M_state_right', $Payload['state_right']);
                    } else {
                        $this->SendDebug('State right', 'Undefined State: ' . $Payload['state_right'], 0);
                    }
                }
                if (array_key_exists('window_detection', $Payload)) {
                    $this->handleStateChange('window_detection', 'Z2M_WindowDetection', 'Window_Detection', $Payload);
                }
                if (array_key_exists('open_window', $Payload)) {
                    $this->handleStateChange('open_window', 'Z2M_OpenWindow', 'Open Window', $Payload);
                }
                if (array_key_exists('window_open', $Payload)) {
                    $this->handleStateChange('window_open', 'Z2M_WindowOpen', 'Window Open', $Payload);
                }
                if (array_key_exists('button_lock', $Payload)) {
                    $this->handleStateChange('button_lock', 'Z2M_ButtonLock', 'Button Lock', $Payload);
                }
                if (array_key_exists('open_window_temperature', $Payload)) {
                    $this->SetValue('Z2M_OpenWindowTemperature', $Payload['open_window_temperature']);
                }
                if (array_key_exists('holiday_temperature', $Payload)) {
                    $this->SetValue('Z2M_HolidayTemperature', $Payload['holiday_temperature']);
                }
                if (array_key_exists('boost_timeset_countdown', $Payload)) {
                    $this->SetValue('Z2M_BoostTimesetCountdown', $Payload['boost_timeset_countdown']);
                }
                if (array_key_exists('frost_protection', $Payload)) {
                    $this->handleStateChange('open_window', 'Z2M_OpenWindow', 'Open Window', $Payload);
                }
                if (array_key_exists('heating_stop', $Payload)) {
                    $this->handleStateChange('heating_stop', 'Z2M_HeatingStop', 'Heating Stop', $Payload);
                }
                if (array_key_exists('test', $Payload)) {
                    $this->SetValue('Z2M_Test', $Payload['test']);
                }
                if (array_key_exists('valve_detection', $Payload)) {
                    $this->handleStateChange('valve_detection', 'Z2M_ValveDetection', 'Valve Detection', $Payload);
                }
                if (array_key_exists('auto_lock', $Payload)) {
                    $this->handleStateChange('auto_lock', 'Z2M_AutoLock', 'Auto Lock', $Payload);
                }
                if (array_key_exists('child_lock', $Payload)) {
                    $this->handleStateChange('child_lock', 'Z2M_ChildLock', 'Child Lock', $Payload, ['LOCK' => true, 'UNLOCK' => false]);
                }
                if (array_key_exists('update_available', $Payload)) {
                    //Bleibt hier. gibt es nicht als Expose
                    $this->RegisterVariableBoolean('Z2M_Update', $this->Translate('Update'), '');
                    $this->SetValue('Z2M_Update', $Payload['update_available']);
                }
                if (array_key_exists('voc', $Payload)) {
                    $this->SetValue('Z2M_VOC', $Payload['voc']);
                }
                if (array_key_exists('pm25', $Payload)) {
                    $this->SetValue('Z2M_PM25', $Payload['pm25']);
                }
                if (array_key_exists('co2', $Payload)) {
                    $this->SetValue('Z2M_CO2', $Payload['co2']);
                }
                if (array_key_exists('formaldehyd', $Payload)) {
                    $this->SetValue('Z2M_Formaldehyd', $Payload['formaldehyd']);
                }
                if (array_key_exists('force', $Payload)) {
                    $this->SetValue('Z2M_Force', $Payload['force']);
                }
                if (array_key_exists('moving', $Payload)) {
                    $this->SetValue('Z2M_Moving', $Payload['moving']);
                }
                if (array_key_exists('moving_left', $Payload)) {
                    $this->SetValue('Z2M_MovingLeft', $Payload['moving_left']);
                }
                if (array_key_exists('moving_right', $Payload)) {
                    $this->SetValue('Z2M_MovingRight', $Payload['moving_right']);
                }
                if (array_key_exists('trv_mode', $Payload)) {
                    $this->SetValue('Z2M_TRVMode', $Payload['trv_mode']);
                }
                if (array_key_exists('calibration', $Payload)) {
                    $this->handleStateChange('calibration', 'Z2M_Calibration', 'Calibration', $Payload);
                }
                if (array_key_exists('calibration_left', $Payload)) {
                    $this->handleStateChange('calibration_left', 'Z2M_CalibrationLeft', 'Calibration Left', $Payload);
                }
                if (array_key_exists('calibration_right', $Payload)) {
                    $this->handleStateChange('calibration_right', 'Z2M_CalibrationRight', 'Calibration Right', $Payload);
                }
                if (array_key_exists('motor_reversal', $Payload)) {
                    $this->handleStateChange('motor_reversal', 'Z2M_MotorReversal', 'Motor Reversal', $Payload);
                }
                if (array_key_exists('motor_reversal_left', $Payload)) {
                    $this->handleStateChange('motor_reversal_left', 'Z2M_MotorReversalLeft', 'Motor Reversal Left', $Payload);
                }
                if (array_key_exists('motor_reversal_right', $Payload)) {
                    $this->handleStateChange('motor_reversal_right', 'Z2M_MotorReversalRight', 'Motor Reversal Right', $Payload);
                }
                if (array_key_exists('calibration_time', $Payload)) {
                    $this->SetValue('Z2M_CalibrationTime', $Payload['calibration_time']);
                }
                if (array_key_exists('calibration_time_left', $Payload)) {
                    $this->SetValue('Z2M_CalibrationTimeLeft', $Payload['calibration_time_left']);
                }
                if (array_key_exists('calibration_time_right', $Payload)) {
                    $this->SetValue('Z2M_CalibrationTimeRight', $Payload['calibration_time_right']);
                }
                if (array_key_exists('target_distance', $Payload)) {
                    $this->SetValue('Z2M_TargetDistance', $Payload['target_distance']);
                }
                if (array_key_exists('minimum_range', $Payload)) {
                    $this->SetValue('Z2M_MinimumRange', $Payload['minimum_range']);
                }
                if (array_key_exists('maximum_range', $Payload)) {
                    $this->SetValue('Z2M_MaximumRange', $Payload['maximum_range']);
                }
                if (array_key_exists('deadzone_temperature', $Payload)) {
                    $this->SetValue('Z2M_DeadzoneTemperature', $Payload['deadzone_temperature']);
                }
                if (array_key_exists('max_temperature_limit', $Payload)) {
                    $this->SetValue('Z2M_MaxTemperatureLimit', $Payload['max_temperature_limit']);
                }
                if (array_key_exists('detection_delay', $Payload)) {
                    $this->SetValue('Z2M_DetectionDelay', $Payload['detection_delay']);
                }
                if (array_key_exists('fading_time', $Payload)) {
                    $this->SetValue('Z2M_FadingTime', $Payload['fading_time']);
                }
                if (array_key_exists('trigger', $Payload)) {
                    $this->handleStateChange('trigger', 'Z2M_Trigger', 'Trigger', $Payload);
                }
                if (array_key_exists('garage_door_contact', $Payload)) {
                    $this->SetValue('Z2M_GarageDoorContact', $Payload['garage_door_contact']);
                }
                if (array_key_exists('brightness_level', $Payload)) {
                    $this->SetValue('Z2M_BrightnessLevel', $Payload['brightness_level']);
                }
                if (array_key_exists('trigger_indicator', $Payload)) {
                    $this->SetValue('Z2M_TriggerIndicator', $Payload['trigger_indicator']);
                }
                if (array_key_exists('factory_reset', $Payload)) {
                    $this->SetValue('Z2M_FactoryReset', $Payload['factory_reset']);
                }
                if (array_key_exists('action_code', $Payload)) {
                    $this->SetValue('Z2M_ActionCode', $Payload['action_code']);
                }
                if (array_key_exists('action_transaction', $Payload)) {
                    $this->SetValue('Z2M_ActionTransaction', $Payload['action_transaction']);
                }
                if (array_key_exists('vibration', $Payload)) {
                    $this->SetValue('Z2M_Vibration', $Payload['vibration']);
                }
            }
        }
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

    public function Z2MSet($payload)
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

    protected function createVariableProfiles()
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

    protected function SetValue($Ident, $Value)
    {
        if (@$this->GetIDForIdent($Ident)) {
            $this->SendDebug('Info :: SetValue for ' . $Ident, 'Value: ' . $Value, 0);
            parent::SetValue($Ident, $Value);
        } else {
            $this->SendDebug('Error :: No Expose for Value', 'Ident: ' . $Ident, 0);
        }
    }
    private function handleStateChange($payloadKey, $valueId, $debugTitle, $payload, $stateMapping = null)
    {
        if (array_key_exists($payloadKey, $payload)) {
            $state = $payload[$payloadKey];
            if ($stateMapping === null) {
                $stateMapping = ['ON' => true, 'OFF' => false];
            }
            if (array_key_exists($state, $stateMapping)) {
                $this->SetValue($valueId, $stateMapping[$state]);
            } else {
                $this->SendDebug($debugTitle, 'Undefined State: ' . $state, 0);
            }
        }
    }

    private function setColor(int $color, string $mode, string $Z2MMode = 'color')
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

    private function OnOff(bool $Value)
    {
        switch ($Value) {
            case true:
                $state = 'ON';
                break;
            case false:
                $state = 'OFF';
                break;
        }
        return $state;
    }

    private function ValveState(bool $Value)
    {
        switch ($Value) {
            case true:
                $state = 'OPEN';
                break;
            case false:
                $state = 'CLOSED';
                break;
        }
        return $state;
    }

    private function LockUnlock(bool $Value)
    {
        switch ($Value) {
            case true:
                $state = 'LOCK';
                break;
            case false:
                $state = 'UNLOCK';
                break;
        }
        return $state;
    }

    private function OpenClose(bool $Value)
    {
        switch ($Value) {
            case true:
                $state = 'OPEN';
                break;
            case false:
                $state = 'CLOSE';
                break;
        }
        return $state;
    }

    private function AutoManual(bool $Value)
    {
        switch ($Value) {
            case true:
                $state = 'AUTO';
                break;
            case false:
                $state = 'MANUAL';
                break;
        }
        return $state;
    }

    private function registerVariableProfile($expose)
    {
        $ProfileName = 'Z2M.' . $expose['name'];
        $unit = isset($expose['unit']) ? ' ' . $expose['unit'] : '';

        switch ($expose['type']) {
            case 'binary':
                // Sonderfall "consumer_connected". Alle anderen werden als Switch angelegt
                switch ($expose['property']) {
                    case 'consumer_connected':
                        if (!IPS_VariableProfileExists($ProfileName)) {
                            $this->RegisterProfileBooleanEx($ProfileName, 'Plug', '', '', [
                                [false, $this->Translate('not connected'),  '', 0xFF0000],
                                [true, $this->Translate('connected'),  '', 0x00FF00]
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
                    $ProfileName .= '.' . dechex(crc32($tmpProfileName)); // Ergänzung um Individuelle Profile zu erhalten, wenn die Werte sich unterscheiden
                    if (!IPS_VariableProfileExists($ProfileName)) {
                        $profileValues = [];
                        foreach ($expose['values'] as $value) {
                            $readableValue = ucwords(str_replace('_', ' ', $value));
                            $translatedValue = $this->Translate($readableValue);
                            // Debug-Ausgabe, wenn Werte nicht in /device/locale.json übersetzt wurden
                            if ($translatedValue === $readableValue) {
                                $this->SendDebug(__FUNCTION__ . ':: Missing Translation', "Keine Übersetzung für Wert: $readableValue", 0);
                            }
                            $profileValues[] = [$value, $translatedValue, '', 0x00FF00];
                        }
                        $this->RegisterProfileStringEx($ProfileName, 'Menu', '', '', $profileValues); // Profilerstellung mit Icon "Menu"
                    }
                } else {
                    $this->SendDebug(__FUNCTION__ . ':: Variableprofile missing', $ProfileName, 0);
                    $this->SendDebug(__FUNCTION__ . ':: ProfileName Values', json_encode($expose['values']), 0);
                    return false;
                }
                break;

            case 'numeric':
                $ProfileName = 'Z2M.' . $expose['name'];
                $min = $expose['value_min'] ?? 0;
                $max = $expose['value_max'] ?? 0;
                $step = $expose['value_step'] ?? 0; // wird zur Feststellung benötigt ob der Wert als Integer oder Float interpretiert werden muss
                $fullRangeProfileName = $ProfileName . $min . '_' . $max;
                $presetProfileName = $fullRangeProfileName . '_Presets'; // wenn presets im Payload angeboten werden, Erstellen eines zusätzlichen Preset-Profils
                $unit = isset($expose['unit']) ? ' ' . $expose['unit'] : '';

                $this->SendDebug("registerNumericProfile", "ProfileName: $fullRangeProfileName, min: $min, max: $max, unit: $unit, step: $step", 0);

                if (!IPS_VariableProfileExists($fullRangeProfileName)) {
                    // Prüfung ob der Schritt ein Dezimalwert ist
                    if (is_float($step) || strpos((string)$step, '.') !== false) {
                        $this->RegisterProfileFloat($fullRangeProfileName, '', '', $unit, $min, $max, $step);
                    } else {
                        $this->RegisterProfileInteger($fullRangeProfileName, '', '', $unit, $min, $max, $step);
                    }
                }
                // Erstellung der Presets aus dem Payload in das Profil
                if (isset($expose['presets']) && !empty($expose['presets'])) {
                    if (IPS_VariableProfileExists($presetProfileName)) {
                        IPS_DeleteVariableProfile($presetProfileName);
                    }
                    $this->RegisterProfileInteger($presetProfileName, 'Bulb', '', '', 0, 0, 0);
                    foreach ($expose['presets'] as $preset) {
                        $presetValue = $preset['value'];
                        $presetName = $this->Translate(ucwords(str_replace('_', ' ', $preset['name'])));
                        $this->SendDebug("Preset Info", "presetValue: $presetValue, presetName: $presetName", 0);
                        IPS_SetVariableProfileAssociation($presetProfileName, $presetValue, $presetName, '', 0xFFFFFF);
                    }
                }
                break;
                return ['mainProfile' => $fullRangeProfileName, 'presetProfile' => $presetProfileName];
            default:
                $this->SendDebug(__FUNCTION__ . ':: Type not handled', $ProfileName, 0);
                return false;
        }
    }

    private function mapExposesToVariables(array $exposes)
    {
        foreach ($exposes as $expose) {
            $featureType = $expose['type'];
            $variableId = 'Z2M_' . ucfirst($expose['property']);
            $translation = $this->Translate($expose['label']);
            $profileResult = $this->registerVariableProfile($expose);

            if ($profileResult === false) {
                $this->SendDebug(__FUNCTION__ . ':: Profile creation failed', json_encode($expose), 0);
                continue; // Skip this expose if profile creation fails
            }

            // Prepare profile name for variable registration based on type
            $profileName = is_array($profileResult) ? $profileResult['mainProfile'] : $profileResult;

            // Register the variable based on the type
            $this->registerVariable($variableId, $translation, $profileName, $featureType, $expose);

            // Enable action if the variable is writable
            if (isset($expose['access']) && ($expose['access'] & 0b010)) {
                $this->EnableAction($variableId);
            }
        }
    }

        private function registerVariable($variableId, $translation, $profileName, $featureType, $expose)
        {
            switch ($featureType) {
                case 'numeric':
                    $step = $expose['value_step'] ?? 0;
                    if (is_float($step) || strpos((string)$step, '.') !== false) {
                        $this->RegisterVariableFloat($variableId, $translation, $profileName, $expose['value_min'], $expose['value_max'], $step);
                    } else {
                        $this->RegisterVariableInteger($variableId, $translation, $profileName, $expose['value_min'], $expose['value_max'], $step);
                    }
                    break;
                case 'binary':
                case 'enum':
                    $this->RegisterVariableString($variableId, $translation, $profileName);
                    break;
                default:
                    $this->SendDebug(__FUNCTION__ . ':: Unsupported type', $featureType, 0);
            }
        }

        // Hier werden weitere Hilfsfunktionen wie Translate, SendDebug, RegisterVariableFloat, etc. angenommen.
}
