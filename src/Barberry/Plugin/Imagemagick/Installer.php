<?php
namespace Barberry\Plugin\Imagemagick;

use Barberry\Plugin;
use Barberry\Direction;
use Barberry\Monitor;
use Barberry\ContentType;

class Installer implements Plugin\InterfaceInstaller
{
    public function install(Direction\ComposerInterface $directionComposer, Monitor\ComposerInterface $monitorComposer,
        $pluginParams = array())
    {
        foreach (self::directions() as $pair) {
            $directionComposer->writeClassDeclaration(
                $pair[0],
                $pair[1],
                'new Plugin\\Imagemagick\\Converter(ContentType::byExtention("'.$pair[0]->standardExtension().'"))',
                'new Plugin\\Imagemagick\\Command'
            );
        }

        $monitorComposer->writeClassDeclaration('Imagemagick');
    }

//--------------------------------------------------------------------------------------------------

    private static function directions()
    {
        return array(
            array(ContentType::jpeg(), \Barberry\ContentType::gif()),
            array(ContentType::jpeg(), \Barberry\ContentType::png()),
            array(ContentType::jpeg(), \Barberry\ContentType::jpeg()),
            array(ContentType::gif(), \Barberry\ContentType::jpeg()),
            array(ContentType::gif(), \Barberry\ContentType::png()),
            array(ContentType::gif(), \Barberry\ContentType::gif()),
            array(ContentType::png(), \Barberry\ContentType::jpeg()),
            array(ContentType::png(), \Barberry\ContentType::gif()),
            array(ContentType::png(), \Barberry\ContentType::png()),
            array(ContentType::pdf(), \Barberry\ContentType::jpeg()),
            array(ContentType::pdf(), \Barberry\ContentType::png()),
            array(ContentType::pdf(), \Barberry\ContentType::gif()),
        );
    }
}
