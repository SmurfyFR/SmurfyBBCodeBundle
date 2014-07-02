<?php
namespace Smurfy\BBCodeBundle\Twig;

class SmurfyBBCodeExtension extends \Twig_Extension
{

	public function getFilters()
    {
        return array(
            'bbcode' => new \Twig_Filter_Method($this, 'bbcodeFilter'),
        );
    }

    public function bbcodeFilter($content)
    {
        require_once('SBBCodeParser.php');

		$parser = new \SBBCodeParser\Node_Container_Document();

        $content = $parser->parse($content)
            ->detect_links()
            ->detect_emails()
            //->detect_emoticons()
            ->get_html();
			
        return $content;
    }

    public function getName()
    {
        return 'smurfy_bbcode_extension';
    }
}