<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Info extends Block
{
	public $name = 'Informacje o domach';
	public $description = 'info';
	public $slug = 'info';
	public $category = 'formatting';
	public $icon = 'align-pull-left';
	public $keywords = ['tresc', 'zdjecie'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
		'anchor' => true,
		'customClassName' => true,
	];

	public function fields()
	{
		$info = new FieldsBuilder('info');

		$info
			->setLocation('block', '==', 'acf/info') // ważne!
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Informacje o domach',
				'open' => false,
				'multi_expand' => true,
			])
			/*--- GROUP ---*/
			->addTab('Elementy', ['placement' => 'top'])
			->addGroup('g_info', ['label' => ''])
			->addImage('image', [
				'label' => 'Obraz',
				'return_format' => 'array',
				'preview_size' => 'thumbnail',
			])
			->addText('title', ['label' => 'Tytuł'])
			->addText('header', ['label' => 'Nagłówek'])
			->addWysiwyg('txt', [
				'label' => 'Treść',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => true,
			])
			->addLink('button', [
				'label' => 'Przycisk',
				'return_format' => 'array',
			])
			->addImage('bg', [
				'label' => 'Tło',
				'return_format' => 'array',
				'preview_size' => 'thumbnail',
			])
			->endGroup()

			/*--- TAB #2 ---*/
			->addTab('Oferta', ['placement' => 'top'])
		->addRepeater('r_info', [
    'label' => 'Oferta',
    'button_label' => 'Dodaj ofertę',
    'layout' => 'table' // 'table' lub 'block' layout jest zazwyczaj lepszy dla pól z różną szerokością
])
    ->addText('dom', [
        'label' => 'Dom',
        'wrapper' => [
            'width' => '10', // Ustawiasz szerokość w procentach
        ],
    ])
    ->addFile('prospekt', [
        'label' => 'Prospekt',
        'return_format' => 'array',
        'wrapper' => [
            'width' => '15', // Możesz to zrobić dla każdego pola
        ],
    ])
    ->addText('cena', [
        'label' => 'Cena',
        'wrapper' => [
            'width' => '15',
        ],
    ])
    ->addText('metraz', [
        'label' => 'Metraż',
        'wrapper' => [
            'width' => '15',
        ],
    ])
    ->addText('dzialka', [
        'label' => 'Działka',
        'wrapper' => [
            'width' => '15',
        ],
    ])
    ->addSelect('status', [
        'label' => 'Wybierz opcję',
        'choices' => ['a' => 'Dostępny', 'b' => 'Zarezerwowany', 'c' => 'Sprzedany'],
        'default_value' => 'a',
        'allow_null' => 0,
        'multiple' => 0,
        'ui' => 1,
        'wrapper' => [
            'width' => '15',
        ],
    ])
    ->addFile('karta', [
        'label' => 'Karta',
        'return_format' => 'array',
        'wrapper' => [
            'width' => '15',
        ],
    ])
->endRepeater()

			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addText('section_id', [
				'label' => 'ID',
			])
			->addText('section_class', [
				'label' => 'Dodatkowe klasy CSS',
			])
			->addTrueFalse('nolist', [
				'label' => 'Brak punktatorów',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('wide', [
				'label' => 'Szeroka kolumna',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('nomt', [
				'label' => 'Usunięcie marginesu górnego',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('gap', [
				'label' => 'Większy odstęp',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addSelect('background', [
				'label' => 'Kolor tła',
				'choices' => [
					'none' => 'Brak (domyślne)',
					'section-white' => 'Białe',
					'section-light' => 'Jasne',
					'section-base' => 'Podstawowe',
					'section-brand' => 'Marki',
					'section-gradient' => 'Gradient',
					'section-dark' => 'Ciemne',
				],
				'default_value' => 'none',
				'ui' => 0, // Ulepszony interfejs
				'allow_null' => 0,
			]);

		return $info;
	}

	public function with()
	{
		return [
			'g_info' => get_field('g_info'),
			'r_info' => get_field('r_info'),
			'section_id' => get_field('section_id'),
			'section_class' => get_field('section_class'),
			'nolist' => get_field('nolist'),
			'flip' => get_field('flip'),
			'wide' => get_field('wide'),
			'nomt' => get_field('nomt'),
			'gap' => get_field('gap'),
			'background' => get_field('background'),
		];
	}
}
