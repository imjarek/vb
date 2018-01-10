<?php

namespace App\Helpers;

use Session;

class ToastrHelper {

    private $options;
    private $title;
    private $message;
    private $type;

    public function reset()
    {
        $this->options = [
            'tapToDismiss' => false,
            'debug' => false,
            'showMethod' => "fadeIn",
            'showDuration' => 300,
            'showEasing' => "swing",
            'onShown' => 0,
            'hideMethod' => "fadeOut",
            'hideDuration' => 1000,
            'hideEasing' => "swing",
            'onHidden' => 0,
            'closeMethod' => false,
            'closeDuration' => false,
            'closeEasing' => false,
            'closeOnHover' => true,
            'extendedTimeOut' => 1000,
            'iconClasses' => [
                'error' => "toast-error",
                'info' => "toast-info",
                'success' => "toast-success",
                'warning' => "toast-warning"
            ],
            'positionClass' => "toast-top-full-width",
            'timeOut' => 5000,
            'closeButton' => true,
            'escapeHtml' => false,
            'target' => "body",
            'closeHtml' => '<button type="button" style="font-weight: 100; font-size: 16px" class="ti-close"></button>',
            'newestOnTop' => true,
            'preventDuplicates' => false,
            'progressBar' => true,
            'rtl' => false
        ];
        return $this;
    }

    public function __construct($title = '', $message = '', $type = 'success')
    {
        $this->setMessage($title, $message, $type, true);
        return $this;
    }
    public function __clone()
    {
        return $this;
    }

    public function setMessage($title = '', $message = '', $type = 'success', $reset = true)
    {
        if ($reset) $this->reset();
        $this->title($title);
        $this->message($message);
        $this->type($type);
        return $this;
    }
    public function title($title = '')
    {
        $this->title = $title;
        return $this;
    }
    public function message($message = '')
    {
        $this->message = $message;
        return $this;
    }
    public function type($type = 'success')
    {
        $this->type = in_array($type, ['success', 'info','warning','error']) ? $type : 'success';
        return $this;
    }
    public function positionTopRight()
    {
        $this->options['positionClass'] = 'toast-top-right';
        return $this;
    }
    public function positionBottomRight()
    {
        $this->options['positionClass'] = 'toast-bottom-right';
        return $this;
    }
    public function positionBottomLeft()
    {
        $this->options['positionClass'] = 'toast-bottom-left';
        return $this;
    }
    public function positionTopLeft()
    {
        $this->options['positionClass'] = 'toast-top-left';
        return $this;
    }
    public function positionTopFullWidth()
    {
        $this->options['positionClass'] = 'toast-top-full-width';
        return $this;
    }
    public function positionBottomFullWidth()
    {
        $this->options['positionClass'] = 'toast-bottom-full-width';
        return $this;
    }
    public function positionTopCenter()
    {
        $this->options['positionClass'] = 'toast-top-center';
        return $this;
    }
    public function positionBottomCenter()
    {
        $this->options['positionClass'] = 'toast-bottom-center';
        return $this;
    }
    public function progressBar($on = true)
    {
        $this->options['progressBar'] = (bool)$on;
        return $this;
    }
    public function newestOnTop($on = true)
    {
        $this->options['newestOnTop'] = (bool)$on;
        return $this;
    }
    public function closeButton($on = true)
    {
        $this->options['closeButton'] = (bool)$on;
        return $this;
    }

    public function getArrayMessage()
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'type' => $this->type,
            'options' => $this->options
        ];
    }
    public function getJsonMessage()
    {
        return json_encode($this->getArrayMessage());
    }
    public function getHtmlMessage()
    {
        $dataMessage = $this->getArrayMessage();
        $jsonOptions = json_encode($dataMessage['options']);
        return "<span class='toastr-message'
            data-title='{$dataMessage['title']}'
            data-message='{$dataMessage['message']}'
            data-type='{$dataMessage['type']}'
            data-options='{$jsonOptions}'>
        </span>";
    }
    public function putSessionMessage()
    {
        $messages = Session::pull('toastr-messages', []);
        $messages[] = $this->getHtmlMessage();
        Session::put('toastr-messages', $messages);
    }

}