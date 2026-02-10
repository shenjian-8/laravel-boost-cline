<?php

namespace Laravel\BoostCline\Tests;

use Laravel\BoostCline\ClineAgent;
use Laravel\Boost\Install\Enums\Platform;
use PHPUnit\Framework\TestCase;

class ClineAgentTest extends TestCase
{
    public function test_agent_has_correct_name()
    {
        $strategyFactory = $this->createMock(\Laravel\Boost\Install\Detection\DetectionStrategyFactory::class);
        $agent = new ClineAgent($strategyFactory);
        
        $this->assertEquals('cline', $agent->name());
        $this->assertEquals('CLINE', $agent->displayName());
    }

    public function test_system_detection_config()
    {
        $strategyFactory = $this->createMock(\Laravel\Boost\Install\Detection\DetectionStrategyFactory::class);
        $agent = new ClineAgent($strategyFactory);
        
        $darwinConfig = $agent->systemDetectionConfig(Platform::Darwin);
        $linuxConfig = $agent->systemDetectionConfig(Platform::Linux);
        $windowsConfig = $agent->systemDetectionConfig(Platform::Windows);
        
        $this->assertArrayHasKey('command', $darwinConfig);
        $this->assertArrayHasKey('command', $linuxConfig);
        $this->assertArrayHasKey('command', $windowsConfig);
        
        $this->assertStringContainsString('grep "saoudrizwan.claude-dev"', $darwinConfig['command']);
        $this->assertStringContainsString('findstr "saoudrizwan.claude-dev"', $windowsConfig['command']);
    }

    public function test_project_detection_config()
    {
        $strategyFactory = $this->createMock(\Laravel\Boost\Install\Detection\DetectionStrategyFactory::class);
        $agent = new ClineAgent($strategyFactory);
        
        $config = $agent->projectDetectionConfig();
        
        $this->assertIsArray($config);
        $this->assertArrayHasKey('paths', $config);
        $this->assertArrayHasKey('files', $config);
        $this->assertContains('.cline', $config['paths']);
        $this->assertContains('AGENTS.md', $config['files']);
    }

    public function test_guidelines_and_skills_paths()
    {
        $strategyFactory = $this->createMock(\Laravel\Boost\Install\Detection\DetectionStrategyFactory::class);
        $agent = new ClineAgent($strategyFactory);
        
        $this->assertEquals('AGENTS.md', $agent->guidelinesPath());
        $this->assertEquals('.cline/skills', $agent->skillsPath());
    }
}