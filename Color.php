<?php
namespace app\components\color;

/**
 * Class Color
 *
 * Print colored text in cli
 *
 * Note: This class most use in cli!
 *
 * @package app\components
 */
class Color
{

    /**
     * Const
     */
    const ESC_SEQ_PATTERN = "\033[%sm";

    // italic and blink may not work depending of your terminal
    protected $styles = array(
        'reset'            => '0',
        'bold'             => '1',
        'dark'             => '2',
        'italic'           => '3',
        'underline'        => '4',
        'blink'            => '5',
        'reverse'          => '7',
        'concealed'        => '8',

        'default'          => '39',
        'black'            => '30',
        'red'              => '31',
        'green'            => '32',
        'yellow'           => '33',
        'blue'             => '34',
        'magenta'          => '35',
        'cyan'             => '36',
        'light_gray'       => '37',

        'dark_gray'        => '90',
        'light_red'        => '91',
        'light_green'      => '92',
        'light_yellow'     => '93',
        'light_blue'       => '94',
        'light_magenta'    => '95',
        'light_cyan'       => '96',
        'white'            => '97',

        'bg_default'       => '49',
        'bg_black'         => '40',
        'bg_red'           => '41',
        'bg_green'         => '42',
        'bg_yellow'        => '43',
        'bg_blue'          => '44',
        'bg_magenta'       => '45',
        'bg_cyan'          => '46',
        'bg_light_gray'    => '47',

        'bg_dark_gray'     => '100',
        'bg_light_red'     => '101',
        'bg_light_green'   => '102',
        'bg_light_yellow'  => '103',
        'bg_light_blue'    => '104',
        'bg_light_magenta' => '105',
        'bg_light_cyan'    => '106',
        'bg_white'         => '107',
    );

    /**
     * Given text
     *
     * @var string
     */
    private $string;

    /**
     * Color constructor.
     * @param string $string
     */
    public function __construct($string = '')
    {
        $this->string = $string;
    }

    /**
     * @param string $string
     * @return $this
     */
    public function __invoke($string)
    {
        $this->string = $string;
        return $this;
    }

    /**
     * @param string $style
     * @return string
     * @throws \Exception
     */
    public function highlight($style)
    {
        if ($this->isStyleExists($style))
            return $this->buildEscSeq($this->styles[$style]) . $this->string . $this->buildEscSeq($this->styles['reset']);
        return 'Wrong color name';
    }

    /**
     * Check requested style in `$style`
     * @see Color::$styles
     * 
     * @param string $style
     * @return mixed
     */
    protected function isStyleExists($style)
    {
        return array_key_exists($style, $this->styles);
    }
    
    /**
     * @param string $style
     * @return mixed
     */
    protected function buildEscSeq($style)
    {
        return sprintf(self::ESC_SEQ_PATTERN, $style);
    }
}