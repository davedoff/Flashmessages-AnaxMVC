<?php

namespace Dahc\Flashmessage;

//
// Flash messages for Anax-MVC
//
class Flashmessage implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;


    //
    //  Constructor
    //
    public function __construct() {

    }


    //
    // Adding an information message
    // @param string $content
    //
    public function Info($content)
    {
        $this->addMessage('info', $content);
    }

    //
    // Adding a warning message
    // @param string $content
    //
    public function Warning($content)
    {
        $this->addMessage('warning', $content);
    }

    //
    // Adding a success message
    // @param string $content
    //
    public function Success($content)
    {
        $this->addMessage('success', $content);
    }

    //
    // Adding an error message
    // @param string $content
    //
    public function Error($content)
    {
        $this->addMessage('error', $content);
    }

    //
    // Adding your own message
    // @param string $type(for example Warning)
    // @param string $content
    //
    public function addMessage($type, $content)
    {
        $messages = $this->session->get('flashmessage', []);

        $messages[] = [
            'type' => $type,
            'content' => $content,
        ];
        
        $this->session->set('flashmessage', $messages);
    }

    //
    // Clear all messages
    //
    public function clearMessages()
    {
        $this->session->set('flashmessage', []);
    }

    //
    // @return string $html with messages as html
    //
    public function getHtml()
    {
        $this->cssClasses = [
            'info' => 'flashmessage flashmessage-info',
            'warning' => 'flashmessage flashmessage-warning',
            'success' => 'flashmessage flashmessage-success',
            'error' => 'flashmessage flashmessage-error',
        ];

        $messages = $this->session->get('flashmessage', []);

        $html = "";

        foreach($messages as $content) {
            $cssClass = $this->cssClasses[$content['type']];
            $html .= "<div class=\"" . $cssClass . "\">" . htmlspecialchars($content['content']) . "</div>\n";
        }

        $this->clearMessages();
        
        return $html;
    }
}
