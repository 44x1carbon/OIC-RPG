<?php

namespace App\Http\ViewComposers;

use App\Domain\Field\Field;
use App\Domain\Field\FieldRepositoryInterface;
use App\Infrastracture\Field\FieldViewModel;
use Illuminate\View\View;

/**
 * Class FieldViewModelComposer
 * @package App\Http\ViewComposers
 */
class FieldViewModelComposer
{
    /**
     * FieldViewModelComposer constructor.
     * @param FieldRepositoryInterface $fieldRepository
     */
    public function __construct(FieldRepositoryInterface $fieldRepository)
    {
        $this->fieldRepository = $fieldRepository;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('fields', $this->toViewModel());
    }

    /**
     * @return array
     */
    public function toViewModel(): array
    {
        $allField = $this->fieldRepository->all();

        return array_map(function(Field $field) {
            return new FieldViewModel($field);
        }, $allField);
    }
}