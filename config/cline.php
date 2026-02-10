<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cline Agent Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration defines the settings for the Cline agent within
    | the Laravel Boost ecosystem. You can customize the paths and behavior
    | of the Cline agent here.
    |
    */

    'guidelines_path' => env('CLINE_GUIDELINES_PATH', 'AGENTS.md'),

    'skills_path' => env('CLINE_SKILLS_PATH', '.cline/skills'),

    'enabled' => env('CLINE_ENABLED', true),

    'mcp_config_path' => env('CLINE_MCP_CONFIG_PATH'),
];