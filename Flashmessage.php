<?php

namespace Dahc\Flashmessage;

/**
 * Flash messages stored in session for Anax MVC
 */
class Flashmessage implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    private $cssClasses;
    
    /**
     * Constructor
     * @param array $cssClasses Message type CSS classes
     */
    public function __construct() {
        
    }


    /**
     * Add info message
     * @param string $message
     */
    public function Info($content)
    {
        $this->addMessage('info', $content);
    }

    /**
     * Add warning message
     * @param string $message
     */
    public function Warning($content)
    {
        $this->addMessage('warning', $content);
    }

    /**
     * Add success message
     * @param string $message
     */
    public function Success($content)
    {
        $this->addMessage('success', $content);
    }

    /**
     * Add error message
     * @param string $message
     */
    public function Error($content)
    {
        $this->addMessage('error', $content);
    }

    /**
     * Add custom type message
     * @param string $type Message type
     * @param string $message
     */
    public function addMessage($type, $content)
    {
        $messages = $this->session->get('flashmessage', []);

        $messages[] = [
            'type' => $type,
            'content' => $content,
        ];
        
        $this->session->set('flashmessage', $messages);
    }

    /**
     * Delete all messages
     */
    public function clearMessages()
    {
        $this->session->set('flashmessage', []);
    }

    /**
     * Get all flash messages as HTML and delete them
     * @return string All flash messages as HTML
     */
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
