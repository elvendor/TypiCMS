<?php
namespace TypiCMS\Modules\Events\Services\Form;

use TypiCMS\Services\Validation\AbstractLaravelValidator;

class EventFormLaravelValidator extends AbstractLaravelValidator
{

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'start_date' => 'required|date',
        'end_date'   => 'required|date',
        'fr.slug'    => 'required_with:fr.title|required_if:fr.status,1|alpha_dash',
        'nl.slug'    => 'required_with:nl.title|required_if:nl.status,1|alpha_dash',
        'en.slug'    => 'required_with:en.title|required_if:en.status,1|alpha_dash',
    );
}
