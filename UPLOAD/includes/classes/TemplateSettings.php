<?php
class TemplateSettings extends Settings
{
    protected bool $includeConstants = true;

    public function __construct(array $settings = [])
    {
        parent::__construct();

        /**
         * If no $settings were passed to the constructor,
         * look for the global $tpl_settings array and import it.
         */
        if (empty($settings) && !empty($GLOBALS['tpl_settings'])) {
            $this->setFromArray($GLOBALS['tpl_settings']);
        }
    }
}
