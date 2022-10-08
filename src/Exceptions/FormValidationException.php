<?php

namespace App\Exceptions;

use Symfony\Component\Form\FormInterface;

class FormValidationException extends \Exception
{
    private $form;

    public function __construct(FormInterface $form)
    {
        $this->form = $form;
        parent::__construct('Validation Failed', 400);
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * List all errors of a given bound form.
     *
     * @return array
     */
    public function getFormErrors()
    {
        $errors = array();
        // Global
        foreach ($this->form->getErrors() as $error) {
            $errors[$this->form->getName()][] = $error->getMessage();
        }

        // Fields
        foreach ($this->form as $child /** @var FormInterface $child */) {
            if (!$child->isValid()) {
                foreach ($child->getErrors() as $error) {
                    $errors[$child->getName()][] = $error->getMessage();
                }
            }
        }

        return $errors;
    }

    public function getErrorsResponse()
    {
       return json_encode([
            "errors" => $this->getFormErrors(),
            "message" => $this->getMessage()
        ]);
    }
}
