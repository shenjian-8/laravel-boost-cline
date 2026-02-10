<?php

declare(strict_types=1);

namespace Laravel\BoostCline;

use Laravel\Boost\Contracts\SupportsGuidelines;
use Laravel\Boost\Contracts\SupportsMcp;
use Laravel\Boost\Contracts\SupportsSkills;
use Laravel\Boost\Install\Agents\Agent;
use Laravel\Boost\Install\Enums\McpInstallationStrategy;
use Laravel\Boost\Install\Enums\Platform;

class ClineAgent extends Agent implements SupportsGuidelines, SupportsMcp, SupportsSkills
{
    public function name(): string
    {
        return 'cline';
    }

    public function displayName(): string
    {
        return 'CLINE';
    }

    public function systemDetectionConfig(Platform $platform): array
    {
        return match ($platform) {
            Platform::Darwin, Platform::Linux => [
                'command' => 'code --list-extensions | grep "saoudrizwan.claude-dev"',
            ],
            Platform::Windows => [
                'command' => 'code --list-extensions | findstr "saoudrizwan.claude-dev"',
            ],
        };
    }

    public function projectDetectionConfig(): array
    {
        return [
            'paths' => ['.cline'],
            'files' => ['AGENTS.md'],
        ];
    }

    public function mcpInstallationStrategy(): McpInstallationStrategy
    {
        return McpInstallationStrategy::FILE;
    }

    public function mcpConfigPath(): string
    {
        $home = getenv('HOME');
        $platform = Platform::current();
        
        return match ($platform) {
            Platform::Darwin => $home.'/Library/Application Support/Code/User/globalStorage/saoudrizwan.claude-dev/settings/cline_mcp_settings.json',
            Platform::Linux => $home.'/.config/Code/User/globalStorage/saoudrizwan.claude-dev/settings/cline_mcp_settings.json',
            Platform::Windows => getenv('USERPROFILE').'\\AppData\\Roaming\\Code\\User\\globalStorage\\saoudrizwan.claude-dev\\settings\\cline_mcp_settings.json',
        };    
    }

    public function mcpConfigKey(): string
    {
        return 'mcpServers';
    }

    /** {@inheritDoc} */
    public function mcpServerConfig(string $command, array $args = [], array $env = []): array
    {
        return [
            'type' => 'stdio',
            'disabled' => false,
            'command' => $command,
            'args' => [...$args],
            'cwd' => base_path(),
        ];
    }

    public function guidelinesPath(): string
    {
        return config('boost.agents.cline.guidelines_path', 'AGENTS.md');
    }

    public function skillsPath(): string
    {
        return config('boost.agents.cline.skills_path', '.cline/skills');
    }
}