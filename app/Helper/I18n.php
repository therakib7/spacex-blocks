<?php
namespace Bfsb\Helper;

class I18n
{
    static function dashboard()
    {
        return [
            //modules
            "db" => esc_html__("Dashboard", "spacex-blocks"),
           
            //alert
            "scf" => esc_html__("Successfully", "spacex-blocks"),
            "aAdd" => esc_html__("Successfully Added", "spacex-blocks"),
            "aUpd" => esc_html__("Successfully Updated", "spacex-blocks"),
            "aDel" => esc_html__("Successfully Deleted", "spacex-blocks"),
            "aThankM" => esc_html__("Thanks for your message", "spacex-blocks"),
            "aThankR" => esc_html__("Thanks for payment request", "spacex-blocks"),
            "aMail" => esc_html__("Mail successfully sent", "spacex-blocks"),
            "aConf" => esc_html__("Are you sure to delete it?", "spacex-blocks"),
            "cp" => esc_html__("Copied", "spacex-blocks"),  
        ];
    }
}
