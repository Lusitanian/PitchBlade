<?php

namespace PitchBladeTest\Unit\I18n\Language;

use PitchBlade\I18n\Language\BrowserRecognizer;

class BrowserRecognizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::__construct
     */
    public function testConstructCorrectInterface()
    {
        $recognizer = new BrowserRecognizer(
            [],
            $this->getMock('\\PitchBlade\\Network\\Http\\RequestData')
        );

        $this->assertInstanceOf(
            '\\PitchBlade\\I18n\\Language\\Recognizer',
            $recognizer
        );
    }

    /**
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::__construct
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::getLanguage
     */
    public function testGetLanguageFoundLanguage()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->at(0))
            ->method('server')
            ->will($this->returnValue('nl-NL'));
        $request->expects($this->at(1))
            ->method('server')
            ->will($this->returnValue('nl-NL'));

        $recognizer = new BrowserRecognizer(['nl'], $request);

        $this->assertSame('nl', $recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::__construct
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::getLanguage
     */
    public function testGetLanguageUnsupportedLanguage()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->at(0))
            ->method('server')
            ->will($this->returnValue('en-US'));

        $recognizer = new BrowserRecognizer(['nl'], $request);

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::__construct
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::getLanguage
     */
    public function testGetLanguageWithoutLanguages()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->at(0))
            ->method('server')
            ->will($this->returnValue('en-US'));

        $recognizer = new BrowserRecognizer([], $request);

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::__construct
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::getLanguage
     */
    public function testGetLanguageWithoutValidLanguageHeader()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->at(0))
            ->method('server')
            ->will($this->returnValue('e'));

        $recognizer = new BrowserRecognizer([], $request);

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::__construct
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::getLanguage
     */
    public function testGetLanguageWithoutLanguageHeader()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->at(0))
            ->method('server')
            ->will($this->returnValue(null));

        $recognizer = new BrowserRecognizer([], $request);

        $this->assertNull($recognizer->getLanguage());
    }
}
