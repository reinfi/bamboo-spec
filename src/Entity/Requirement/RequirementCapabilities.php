<?php

declare(strict_types=1);

namespace Reinfi\BambooSpec\Entity\Requirement;

/**
 * This list might not be correct and it might be missing values.
 *
 * @package Reinfi\BambooSpec\Entity\Requirement
 */
abstract class RequirementCapabilities
{
    public const ANT = 'system.builder.ant.Ant';
    public const ANT_1_8 = 'system.builder.ant.Ant 1.8';
    public const ANT_1_9 = 'system.builder.ant.Ant 1.9';
    public const ANT_1_10 = 'system.builder.ant.Ant 1.10';

    public const DOCKER = 'system.docker.executable';

    public const GIT = 'system.git.executable';

    public const GRAILS_2_1 = 'system.builder.grailsBuilder.Grails 2.1';
    public const GRAILS_2_2 = 'system.builder.grailsBuilder.Grails 2.2';
    public const GRAILS_2_3 = 'system.builder.grailsBuilder.Grails 2.3';
    public const GRAILS_2_4 = 'system.builder.grailsBuilder.Grails 2.4';
    public const GRAILS_3_0 = 'system.builder.grailsBuilder.Grails 3.0';
    public const GRAILS_3_1 = 'system.builder.grailsBuilder.Grails 3.1';
    public const GRAILS_3_2 = 'system.builder.grailsBuilder.Grails 3.2';
    public const GRAILS_3_3 = 'system.builder.grailsBuilder.Grails 3.3';

    public const JDK_8 = 'system.jdk.JDK 8';
    public const JDK_10 = 'system.jdk.JDK 10';

    public const MAVEN_2 = 'system.builder.mvn2.Maven 2';
    public const MAVEN_2_0 = 'system.builder.mvn2.Maven 2.0';
    public const MAVEN_2_1 = 'system.builder.mvn2.Maven 2.1';
    public const MAVEN_2_2 = 'system.builder.mvn2.Maven 2.2';
    public const MAVEN_3 = 'system.builder.mvn2.Maven 3';
    public const MAVEN_3_0 = 'system.builder.mvn3.Maven 3.0';
    public const MAVEN_3_1 = 'system.builder.mvn3.Maven 3.1';
    public const MAVEN_3_2 = 'system.builder.mvn3.Maven 3.2';
    public const MAVEN_3_3 = 'system.builder.mvn3.Maven 3.3';
    public const MAVEN_3_5 = 'system.builder.mvn3.Maven 3.5';

    public const MERCURIAL = 'system.hg.executable';

    public const MS_BUILD_32BIT = 'system.builder.msbuild.MSBuild v4.0 (32bit)';
    public const MS_BUILD_64BIT = 'system.builder.msbuild.MSBuild v4.0 (64bit)';

    public const NANT = 'system.builder.nant.Nant';

    public const NODE_JS_4 = 'system.builder.node.Node.js 4';
    public const NODE_JS_5 = 'system.builder.node.Node.js 5';
    public const NODE_JS_6 = 'system.builder.node.Node.js 6';
    public const NODE_JS_8 = 'system.builder.node.Node.js 8';
}
