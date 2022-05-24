<?php

namespace Acme\Reports;

use Laravel\Nova\ResourceTool;

class Reports extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Reports';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'reports';
    }
}
