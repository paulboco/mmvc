<?php

namespace Support;

class View
{
    /**
     * Path to the view files.
     *
     * @var string
     */
    private $path = '/App/views/';

    /**
     * File extension for view files.
     *
     * @var string
     */
    private $extension = '.php';

    /**
     * Get an instance of the view class.
     *
     * @return View
     */
    public static function instance()
    {
        return new static;
    }

    /**
     * Make a view.
     *
     * @param  string  $template
     * @param  array  $data
     * @return string
     */
    public function make($template, $data = array())
    {
        ob_start();
        $this->render($template, $data);

        return ob_get_clean();
    }

    /**
     * Inject a view.
     *
     * @param  string  $template
     * @param  array  $data
     * @return void
     */
    public function inject($template, $data = array())
    {
        $this->render($template, $data);
    }

    /**
     * Render the view template.
     *
     * @param  string  $template
     * @param  array  $data
     * @return void
     */
    private function render($template, $data = array())
    {
        extract($data);

        require BASE_PATH . $this->path . $template . $this->extension;
    }
}
