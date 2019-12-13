<?php
namespace App\EventListener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class TrucListener
{
    public function idBook(FilterResponseEvent $event)
    {

        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
          }
          
        // Retrieve the Kernel Response
        $response = $event->getResponse();

        // Retrieve the HTML content of the response
        $content = $response->getContent();

        // Retrieve th <ul> tag
        $regex_ul = "@\<ul\b[^>]*>(?:[.\n\s\t\>]*<li>*<\/li>)*[.\n\s\t\>]*<\/ul>mi@";
        preg_match($regex_ul, $content, $matches);

        $ul_tag = $matches[0] ?? null;
        $li_tag = explode("<li>", $ul_tag);

        $new_ul_tag = "";
        foreach($li_tag as $key => $value)
        {
            $new_ul_tag = ($key ? "<li>".$key.") " : null ) . $value;
        }

        $content = preg_replace("@".$ul_tag."@", $new_ul_tag, $content);
        
        $response->setContent($content);

        $event->setResponse($response);
    }
}