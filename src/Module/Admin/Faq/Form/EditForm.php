<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    MIT
 */

declare(strict_types=1);

namespace Lyrasoft\Faq\Module\Admin\Faq\Form;

use Lyrasoft\Luna\Field\CategoryListField;
use Lyrasoft\Luna\Field\UserModalField;
use Unicorn\Field\CalendarField;
use Unicorn\Field\SingleImageDragField;
use Unicorn\Field\SwitcherField;
use Unicorn\Field\TinymceEditorField;
use Windwalker\Core\Language\TranslatorTrait;
use Windwalker\Form\Field\HiddenField;
use Windwalker\Form\Field\TextField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;

/**
 * The EditForm class.
 */
class EditForm implements FieldDefinitionInterface
{
    use TranslatorTrait;

    /**
     * Define the form fields.
     *
     * @param Form $form The Windwalker form object.
     *
     * @return  void
     */
    public function define(Form $form): void
    {
        $form->add('id', HiddenField::class);

        $form->add('title', TextField::class)
            ->label('標題')
            ->addFilter('trim')
            ->required(true);

        $form->fieldset(
            'basic',
            function (Form $form) {
                $form->add('category_id', CategoryListField::class)
                    ->label($this->trans('faq.field.category'))
                    ->categoryType('faq')
                    ->option($this->trans('unicorn.select.placeholder'), '')
                    ->required(true);

                $form->add('image', SingleImageDragField::class)
                    ->label($this->trans('unicorn.field.image'))
                    ->showSizeNotice(true)
                    ->crop(true)
                    ->width(400)
                    ->height(400);

                $form->add('description', TinymceEditorField::class)
                    ->label($this->trans('faq.field.description'))
                    ->editorOptions(
                        [
                            'height' => 450,
                        ]
                    )
                    ->rows(5);
            }
        );

        $form->fieldset(
            'meta',
            function (Form $form) {
                // State
                $form->add('state', SwitcherField::class)
                    ->label($this->trans('unicorn.field.published'))
                    ->addClass('')
                    ->circle(true)
                    ->color('success')
                    ->defaultValue(1);

                // Created
                $form->add('created', CalendarField::class)
                    ->label($this->trans('unicorn.field.created'));

                // Modified
                $form->add('modified', CalendarField::class)
                    ->label($this->trans('unicorn.field.modified'))
                    ->disabled(true);

                // Author
                $form->add('created_by', UserModalField::class)
                    ->label($this->trans('unicorn.field.author'));

                // Modified User
                $form->add('modified_by', UserModalField::class)
                    ->label($this->trans('unicorn.field.modified.by'))
                    ->disabled(true);
            }
        );
    }
}
