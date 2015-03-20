<?php
namespace Histoweb\Components;

use Collective\Html\FormBuilder as Form;
use Illuminate\View\Factory as View;
use Illuminate\Session\Store as Session;

class FieldBuilder {

    protected $form;
    protected $view;
    protected $session;

    protected $defaultTemplate = 'default';

    protected $defaultClass = [
        'default'           => 'form-control',
        'checkbox'          => '',
        'select'            => 'select-chosen'

    ];

    public function __construct(Form $form, View $view,  Session $session)
    {
        $this->form =  $form;
        $this->view = $view;
        $this->session = $session;
    }

    public function getDefaultClass($type)
    {
        if(isset($this->defaultClass[$type]))
        {
            return $this->defaultClass[$type];
        }
        return $this->defaultClass['default'];
    }

    public function  getDefaultTemplate (){

        return $this->defaultTemplate;
    }

    public  function buildCssClasses($type, &$attributes)
    {
        $defaultClasses = $this->getDefaultClass($type);

        if(isset ($attributes['class']))
        {
            $attributes['class'] .= ' '.$defaultClasses;
        }
        else
        {
            $attributes['class'] = $defaultClasses;
        }
    }

    public function buildLabel($name)
    {
        $name = str_replace('[]', '', $name);
        if(\Lang::has('validation.attributes.'.$name))
        {
            $label = \Lang::get('validation.attributes.'.$name);
        }
        else
        {
            $label = str_replace('_', ' ', $name);
        }
        return ucfirst($label);
    }

    public function buildControl($type, $name, $value = null, $attributes = array(), $options = array())
    {
        switch($type)
        {
            case 'select':
                return $this->form->select($name, $options, $value, $attributes);
            case 'password':
                return $this->form->password($name,$attributes);
            case 'checkbox':
                return $this->form->checkbox($name);
            case 'textarea':
                return $this->form->textarea($name, $value, $attributes );
            default:
                return $this->form->input($type, $name, $value, $attributes);
        }
    }

    public function buildError($name)
    {
        $error =null;
        if($this->session->has('errors'))
        {
            $errors = $this->session->get('errors');

            if($errors->has($name))
            {
                $error = $errors->first($name);
            }
        }
        return $error;
    }

    public function  buildTemplate($attributes =array())    {


        if(array_key_exists('template',$attributes) && \File::exists('..\resources\views\fields\\'.$attributes['template'].'.blade.php'))
        {

            return 'fields/'.$attributes['template'];
        }
        return 'fields/'.$this->getDefaultTemplate();
    }

    public  function  input($type, $name, $value = null, $attributes = array(), $options = array())
    {
        $this->buildCssClasses($type, $attributes);
        $label = $this->buildLabel($name);
        $control = $this->buildControl($type, $name, $value , $attributes , $options );
        $error = $this->buildError($name);
        $template = $this->buildTemplate($attributes);

        return $this->view->make($template, compact('name', 'label', 'control', 'error', 'template'));

    }

    public  function select($name, $options, $value = null, $attributes = array())
    {
        if(!in_array('multiple', $attributes))
        {
            $options = ['' => ''] + $options;
        }

        return $this->input('select', $name, $value, $attributes, $options);
    }

    public function  password($name, $attributes = array())
    {
        return $this->input('password', $name, null, $attributes );
    }

    public function __call($method, $params)
    {
        array_unshift($params,$method);
        return call_user_func_array([$this, 'input'],$params);
    }

} 