<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');
function crb_attach_theme_options()
{
    Container::make('theme_options', __('Theme Options'))
     ->add_tab(__('Header & Footer'), array(
             Field::make('image', 'crb_header_logo', __('Логотип в шапке'))
                ->set_value_type('url')
                ->help_text('Загрузите логотип для шапки сайта'),
                
            Field::make('image', 'crb_footer_logo', __('Логотип в подвале'))
                ->set_value_type('url')
                ->help_text('Загрузите логотип для подвала сайта'),
        ))
        ->add_tab(__('Hero Section'), array(
            Field::make('image', 'crb_hero_bg', __('Hero Background Image'))
                ->set_value_type('url'),

            Field::make('text', 'crb_hero_title', __('Hero Title'))
                ->set_default_value('RightOnIT'),

            Field::make('text', 'crb_hero_subtitle', __('Hero Subtitle'))
                ->set_default_value('Immersive Digital Stories <br>Through Technology'),

            Field::make('checkbox', 'crb_hero_gradient', __('Add Gradient Overlay'))
                ->set_option_value('yes'),
        ))
        ->add_tab(__('Intro Section'), array(
            Field::make('image', 'crb_intro_image', __('Intro Image'))
                ->set_value_type('url'),

            Field::make('text', 'crb_intro_title', __('Intro Title')),

            Field::make('textarea', 'crb_intro_description', __('Intro Description')),

            Field::make('select', 'crb_intro_layout', __('Image Position'))
                ->add_options(array(
                    'left' => 'Image Left',
                    'right' => 'Image Right'
                ))
                ->set_default_value('left'),
        ))
        ->add_tab(__('Advantages Section'), array(
            Field::make('text', 'crb_advantages_title', __('Section Title'))
                ->set_default_value('Our Advantages'),

            Field::make('complex', 'crb_advantages_items', __('Advantages Items'))
                ->add_fields(array(
                    Field::make('image', 'icon', __('Icon'))
                        ->set_value_type('url'),

                    Field::make('text', 'title', __('Title')),

                    Field::make('textarea', 'description', __('Description'))
                        ->set_rows(2),
                ))
                ->set_layout('tabbed-horizontal')
                ->set_header_template('<%- title || "Advantage Item" %>')
        ))
->add_tab(__('Featured Projects'), array(
      Field::make('association', 'crb_related_projects', __('Related Projects'))
                ->set_types(array(
                    array(
                        'type' => 'post',
                        'post_type' => 'project',
                    )
                ))
                ->set_help_text(__('Select projects related to this service'))
                ->set_max(10)  
        ->set_max(10)
        ->set_help_text(__('Select projects to feature on the homepage')),

    Field::make('checkbox', 'crb_show_all_projects_link', __('Show "View All Projects" link'))
        ->set_option_value('yes'),

    Field::make('checkbox', 'crb_projects_enabled', __('Enable Projects Section'))
        ->set_option_value('yes')
        ->set_default_value(true),
))

        ->add_tab(__('About Section'), array(
            // Основной заголовок
            Field::make('text', 'crb_about_title', __('About Title'))
                ->set_default_value('We are'),

            // Список преимуществ (Repeater)
            Field::make('complex', 'crb_about_items', __('About Items'))
                ->add_fields(array(
                    Field::make('textarea', 'item_text', __('Item Text'))
                        ->set_rows(3)
                )),

            // Статистика (Repeater)
            Field::make('complex', 'crb_about_stats', __('Statistics Items'))
                ->add_fields(array(
                    Field::make('text', 'stat_value', __('Value'))
                        ->set_attribute('type', 'number'),
                    Field::make('text', 'stat_label', __('Label'))
                ))
        ))
        ->add_tab(__('Choose Wise Section'), array(
            // Заголовок секции
            Field::make('text', 'crb_choose_wise_title', __('Section Title'))
                ->set_attribute('data-parallax', 'true'),

            // Подзаголовок секции
            Field::make('text', 'crb_choose_wise_subtitle', __('Section Subtitle'))
                ->set_attribute('data-parallax', 'true'),

            // Элементы аккордеона
            Field::make('complex', 'crb_choose_wise_accordion', __('Accordion Items'))
                ->add_fields(array(
                    Field::make('text', 'title', __('Item Title')),
                    Field::make('textarea', 'content', __('Item Content'))
                        ->set_rows(4)
                ))
                ->set_layout('tabbed-horizontal')
                ->set_header_template('<%- title || "New Accordion Item" %>')
        ))
        ->add_tab(__('Clients Section'), array(
            // Заголовок секции
            Field::make('text', 'crb_clients_title', __('Section Title'))
                ->set_default_value('Our Clients'),

            // Подзаголовок секции
            Field::make('text', 'crb_clients_subtitle', __('Section Subtitle'))
                ->set_default_value('We are proud to collaborate with these companies'),

            // Логотипы клиентов (повторяемое поле)
            Field::make('media_gallery', 'crb_clients_logos', __('Clients Logos'))
                ->set_type(['image'])
                ->set_duplicates_allowed(false)
        ))
        ->add_tab(__('Contacts Section'), array(
            // Заголовок секции
            Field::make('text', 'crb_contacts_title', __('Section Title'))
                ->set_default_value('Get in Touch'),

            // Контактная информация
            Field::make('text', 'crb_contacts_address', __('Address')),
            Field::make('text', 'crb_contacts_phone', __('Phone')),
            Field::make('text', 'crb_contacts_email', __('Email')),

            // Социальные ссылки (массив с иконками)
            Field::make('complex', 'crb_contacts_socials', __('Social Links'))
                ->set_layout('tabbed-horizontal')
                ->add_fields(array(
                    Field::make('text', 'name', 'Name'),
                    Field::make('text', 'url', 'URL'),
                    Field::make('image', 'icon', 'Icon (SVG/PNG)')
                        ->set_value_type('url'),
                )),

            // Карта
            Field::make('textarea', 'crb_contacts_map', __('Map Embed Code'))
                ->set_help_text('Paste Google Maps embed code here'),
            // Услуги с репитером
            Field::make('complex', 'crb_contacts_services', __('Services'))
                ->add_fields(array(
                    Field::make('text', 'service_name', 'Service Name')
                        ->set_required(true),
                )),
            // Ссылка на страницу с политикой конфиденциальности
            Field::make('text', 'contacts_privacy_policy', __('Privacy Policy URL'))
                ->set_help_text('URL to your privacy policy page'),

            // Подзаголовок и описание          
            Field::make('textarea', 'contacts_subtitle', __('Subtitle')),
            Field::make('rich_text', 'crb_contacts_text', __('Text Block')),
            Field::make('text', 'crb_contacts_note', __('Note')),

            // Вкл/Выкл поля формы
            Field::make('separator', 'crb_contacts_form_sep', 'Form Fields'),
            Field::make('checkbox', 'crb_show_field_name', 'Show Name Field')->set_default_value(true),
            Field::make('checkbox', 'crb_show_field_phone', 'Show Phone Field')->set_default_value(true),
            Field::make('checkbox', 'crb_show_field_message', 'Show Message Field')->set_default_value(true),
            Field::make('checkbox', 'crb_show_field_service', 'Show Services Dropdown')->set_default_value(true),
            Field::make('checkbox', 'crb_show_field_agreement', 'Show Agreement Checkbox')->set_default_value(true),
        ))
        ->add_tab(__('CTA Section'), array(
            Field::make('checkbox', 'crb_global_cta_enabled', __('Enable Global CTA Section'))
                ->set_default_value(true),

            Field::make('text', 'crb_global_cta_title', __('Default Title'))
                ->set_default_value('Ready to transform your website?'),

            Field::make('text', 'crb_global_cta_button_text', __('Default Button Text'))
                ->set_default_value('Start Your Project'),

            Field::make('text', 'crb_global_cta_button_url', __('Default Button URL'))
                ->set_default_value('/contact')
        ))



        ->add_tab(__('Overlay on pages'), array(
            // Section CTA
            Field::make('image', 'cta_page_image', 'Image for CTA')
                ->set_help_text('Upload an image for the CTA section'),
            Field::make('select', 'cta_page_image_filter', 'Filter for CTA')
                ->add_options([
                    '' => 'No filter',
                    'contrast' => 'Contrast',
                    'blur' => 'Blur',
                    'grayscale' => 'Grayscale',
                    'sepia' => 'Sepia',
                    'invert' => 'Invert',
                ]),
            Field::make('text', 'cta_page_image_custom_css', 'Additional CSS properties for CTA section'),

            // Projects
            Field::make('image', 'projects_page_image', 'Image for Projects')
                ->set_help_text('Upload an image for the Projects page'),
            Field::make('select', 'projects_page_image_filter', 'Filter for Projects')
                ->add_options([
                    '' => 'No filter',
                    'contrast' => 'Contrast',
                    'blur' => 'Blur',
                    'grayscale' => 'Grayscale',
                    'sepia' => 'Sepia',
                    'invert' => 'Invert',
                ]),
            Field::make('text', 'projects_page_image_custom_css', 'Additional CSS properties for Projects'),

            // Blogs
            Field::make('image', 'blogs_page_image', 'Image for Blogs')
                ->set_help_text('Upload an image for the Blogs page'),
            Field::make('select', 'blogs_page_image_filter', 'Filter for Blogs')
                ->add_options([
                    '' => 'No filter',
                    'contrast' => 'Contrast',
                    'blur' => 'Blur',
                    'grayscale' => 'Grayscale',
                    'sepia' => 'Sepia',
                    'invert' => 'Invert',
                ]),
            Field::make('text', 'blogs_page_image_custom_css', 'Additional CSS properties for Blogs'),

            // About Us
            Field::make('image', 'about_us_page_image', 'Image for About Us')
                ->set_help_text('Upload an image for the About Us page'),
            Field::make('select', 'about_us_page_image_filter', 'Filter for About Us')
                ->add_options([
                    '' => 'No filter',
                    'contrast' => 'Contrast',
                    'blur' => 'Blur',
                    'grayscale' => 'Grayscale',
                    'sepia' => 'Sepia',
                    'invert' => 'Invert',
                ]),
            Field::make('text', 'about_us_page_image_custom_css', 'Additional CSS properties for About Us'),

            // Contacts
            Field::make('image', 'contacts_page_image', 'Image for Contacts')
                ->set_help_text('Upload an image for the Contacts page'),
            Field::make('select', 'contacts_page_image_filter', 'Filter for Contacts')
                ->add_options([
                    '' => 'No filter',
                    'contrast' => 'Contrast',
                    'blur' => 'Blur',
                    'grayscale' => 'Grayscale',
                    'sepia' => 'Sepia',
                    'invert' => 'Invert',
                ]),
            Field::make('text', 'contacts_page_image_custom_css', 'Additional CSS properties for Contacts'),
        ));
}

add_action('carbon_fields_register_fields', 'register_service_fields');
function register_service_fields()
{
    Container::make('post_meta', __('Service Header Settings'))
        ->where('post_type', '=', 'service')
        ->add_tab(__('Rank sections services'), array(
            Field::make('checkbox', 'section_hero_showing5' , __('Number block on_section_hero show?')),
            Field::make('select', 'on_section_hero', __('Number block section_hero'))
                ->add_options([
                    1 => 'first',
                    2 => 'second',
                    3 => 'third',
                    4 => 'fourth',
                    5 => 'fifth'
                ])
                ->set_default_value('fourth'),
            Field::make('checkbox', 'stages_showing' , __('Number block development stages show?')),
            Field::make('select', 'on_stages', __('Number block development stages'))
                ->add_options([
                    1 => 'first',
                    2 => 'second',
                    3 => 'third',
                    4 => 'fourth',
                    5 => 'fifth'
                ])
                ->set_default_value('first'),
            Field::make('checkbox', 'add_ons_showing2' , __('Number block Add-Ons Section show?')),

            Field::make('select', 'on_add_ons', __('Number block Add-Ons Section'))
                ->add_options([
                    1 => 'first',
                    2 => 'second',
                    3 => 'third',
                    4 => 'fourth',
                    5 => 'fifth'
                ])
                ->set_default_value('second'),
            Field::make('checkbox', 'our_projects_showing3' , __('Number block our_projects show?')),

            Field::make('select', 'on_our_projects', __('Number block our_projects'))
                ->add_options([
                    1 => 'first',
                    2 => 'second',
                    3 => 'third',
                    4 => 'fourth',
                    5 => 'fifth'
                ])
                ->set_default_value('third'),
            Field::make('checkbox', 'project_cta_showing4' , __('Number block on_project_cta show?')),

            Field::make('select', 'on_project_cta', __('Number block project_cta'))
                ->add_options([
                    1 => 'first',
                    2 => 'second',
                    3 => 'third',
                    4 => 'fourth',
                    5 => 'fifth'
                ])
                ->set_default_value('fourth'),




        ))
        ->add_tab(__('Preview Services'), array(
            Field::make('complex', 'crb_services_accordion', 'Пункты аккордеона')
                ->set_layout('tabbed-horizontal')
                ->add_fields(array(
                    Field::make('text', 'accordion_title', 'Заголовок'),
                    Field::make('rich_text', 'accordion_content', 'Описание'),
                ))
        ))
        ->add_tab(__('Section Hero'), array(
            Field::make('text', 'crb_service_subtitle', __('Subtitle')),
            Field::make('rich_text', 'crb_service_description', __('Description'))
        ))
        ->add_tab(__('Development Stages'), array(
            Field::make('text', 'crb_stages_title', __('Section Title'))
                ->set_default_value('Stages develop'),
            Field::make('text', 'crb_stages_sub-title', __('Section Sub-Title')),
            Field::make('complex', 'crb_stages_items', __('Stages Items'))
                ->add_fields(array(
                    Field::make('text', 'number', __('Stage Number'))
                        ->set_width(10),
                    Field::make('text', 'title', __('Stage Title'))
                        ->set_width(90),
                    Field::make('rich_text', 'description', __('Stage Description'))
                ))
                ->set_layout('tabbed-horizontal')
                ->set_header_template('
                    <% if (number) { %>
                        Stage <%= number %>: <%= title %>
                    <% } else { %>
                        New Stage
                    <% } %>
                ')
        ))
        ->add_tab(__('Checkout service'), array(
            Field::make('association', 'crb_related_projects', __('Related Projects'))
                ->set_types(array(
                    array(
                        'type' => 'post',
                        'post_type' => 'project',
                    )
                ))
                ->set_help_text(__('Select projects related to this service'))
                ->set_max(10)
        ))
        ->add_tab(__('Add-Ons Section'), array(
            Field::make('checkbox', 'service_addons_enabled', 'Enable Add-Ons Section')
                ->set_default_value('true'),

            Field::make('text', 'service_addons_title', 'Section Title')
                ->set_default_value('Key Service Add-Ons'),
            Field::make('text', 'service_addons_sub_title', 'Section Sub-Title')
                ->set_default_value('Key Service Add-Ons'),
            Field::make('complex', 'service_addons_items', 'Add-On Items')
                ->add_fields(array(
                    Field::make('text', 'title', 'Service Title')
                        ->set_required(true),
                    Field::make('textarea', 'description', 'Service Description')
                        ->set_rows(3),
                    Field::make('checkbox', 'featured', 'Mark as Featured')
                ))
                ->set_layout('tabbed-horizontal')
                ->set_header_template('
                    <% if (title) { %>
                        <%- title %>
                    <% } else { %>
                        Add-On #<%- $_index + 1 %>
                    <% } %>
                ')
        ))
        ->add_tab(__('Project cta Section'), array(
            Field::make('checkbox', 'crb_project_cta_disabled', __('Disable CTA Section for this project'))
        ));
}


add_action('carbon_fields_register_fields', 'crb_register_project_hero_fields');
function crb_register_project_hero_fields()
{
    Container::make('post_meta', __('Project Settings'))
        ->where('post_type', '=', 'project')
        ->add_tab(__('Rank sections'), array(
            Field::make('select', 'projectdetails_showing' , __('Number block project-details show?'))
                ->add_options([
                    true => 'yes',
                    false => 'no'
                ]),
            Field::make('select', 'on_project_details', __('Number block project-details'))
                ->add_options([
                    1 => 'first',
                    2 => 'second',
                    3 => 'third',
                    4 => 'fourth',
                    5 => 'fifth',
                    6 => 'sixth'
                ])
                ->set_default_value('first'),
            Field::make('select', 'projectcta_showing2' , __('Number block on_project_cta show?'))
                ->add_options([
                true => 'yes',
                false => 'no'
            ]),
            Field::make('select', 'on_project_cta', __('Number block project-cta'))
                ->add_options([
                    1 => 'first',
                    2 => 'second',
                    3 => 'third',
                    4 => 'fourth',
                    5 => 'fifth',
                    6 => 'sixth'
                ])
                ->set_default_value('second'),
            Field::make('select', 'projectgallery_showing3' , __('Number block on_project_gallery show?'))
                ->add_options([
                    true => 'yes',
                    false => 'no'
                ]),
            Field::make('select', 'on_project_gallery', __('Number block project-gallery'))
                ->add_options([
                    1 => 'first',
                    2 => 'second',
                    3 => 'third',
                    4 => 'fourth',
                    5 => 'fifth',
                    6 => 'sixth'
                ])
                ->set_default_value('third'),
            Field::make('select', 'projecttestimonial_showing4' , __('Number block on_project_testimonial show?'))
                ->add_options([
                    true => 'yes',
                    false => 'no'
                ]),
            Field::make('select', 'on_project_testimonial', __('Number block project_testimonial'))
                ->add_options([
                    1 => 'first',
                    2 => 'second',
                    3 => 'third',
                    4 => 'fourth',
                    5 => 'fifth',
                    6 => 'sixth'
                ])
                ->set_default_value('fourth'),
            Field::make('select', 'project_hero_showing5' , __('Number block on_project_hero show?'))
                ->add_options([
                    true => 'yes',
                    false => 'no'
                ]),
            Field::make('select', 'on_project_hero', __('Number block project_hero'))
                ->add_options([
                    1 => 'first',
                    2 => 'second',
                    3 => 'third',
                    4 => 'fourth',
                    5 => 'fifth',
                    6 => 'sixth'
                ])
                ->set_default_value('fourth'),
            Field::make('select', 'project_overview_showing6' , __('Number block on_project_overview show?'))
                ->add_options([
                    true => 'yes',
                    false => 'no'
                ]),
            Field::make('select', 'on_project_overview', __('Number block project_overview'))
                ->add_options([
                    1 => 'first',
                    2 => 'second',
                    3 => 'third',
                    4 => 'fourth',
                    5 => 'fifth',
                    6 => 'sixth'
                ])
                ->set_default_value('fourth'),


        ))
        ->add_tab(__('Project Preview'), array(
            // Цветовая палитра внутри таба
            Field::make('select', 'project_background_color', __('Background Color'))
                ->add_options([
                    '#200368' => 'Dark Blue',
                    '#555559' => 'Dark Gray',
                    '#1a73e8' => 'Google Blue',
                    '#0b8043' => 'Google Green',
                    '#f6bf26' => 'Google Yellow',
                    '#e67c73' => 'Google Red',
                    '#ffffff' => 'White',
                    '#000000' => 'Black'
                ])
                ->set_default_value('#ffffff'),

            Field::make('color', 'project_custom_bg_color', __('Custom Color'))
                ->set_conditional_logic(array(
                    array(
                        'field' => 'project_background_color',
                        'value' => '',
                        'compare' => '='
                    )
                )),
            Field::make('textarea', 'info_text', __('Description'))
        ))
        ->add_tab(__('Hero Section'), array(
            Field::make('checkbox', 'crb_project_hero_enabled', __('Enable Project Hero Section')),

            Field::make('text', 'crb_project_hero_title', __('Title')),

            Field::make('textarea', 'crb_project_hero_description', __('Description')),

            Field::make('complex', 'crb_project_hero_thumbnails', __('Thumbnails'))
                ->set_layout('tabbed-horizontal')
                ->add_fields(array(
                    Field::make('image', 'thumbnail_image', __('Image'))
                        ->set_value_type('url'),
                    Field::make('text', 'thumbnail_alt', __('Alt Text'))
                )),

            Field::make('image', 'crb_project_hero_main_image', __('Main Image'))
                ->set_value_type('url')
        ))
        ->add_tab(__('Overview Section'), array(
            Field::make('checkbox', 'crb_project_overview_enabled', __('Enable Overview Section')),

            Field::make('complex', 'crb_project_overview_items', __('Overview Items'))
                ->set_layout('tabbed-horizontal')
                ->add_fields(array(
                    Field::make('text', 'overview_title', __('Title')),
                    Field::make('textarea', 'overview_content', __('Content')),
                    Field::make('image', 'overview_icon', __('Icon Image'))
                        ->set_value_type('url')
                ))
                ->set_conditional_logic(array(
                    array(
                        'field' => 'crb_project_overview_enabled',
                        'value' => true,
                    )
                ))
                ->set_header_template('
                    <% if (overview_title) { %>
                        <%- overview_title %>
                    <% } else { %>
                        New Item
                    <% } %>
                ')
        ))
        ->add_tab(__('Details Section'), array(
            Field::make('checkbox', 'crb_project_details_enabled', __('Enable Project Details Section')),

            Field::make('text', 'crb_project_details_title', __('Section Title'))
                ->set_conditional_logic(array(
                    array(
                        'field' => 'crb_project_details_enabled',
                        'value' => true,
                    )
                )),

            // The Challenge Block
            Field::make('complex', 'crb_project_challenge', __('The Challenge'))
                ->set_layout('tabbed-horizontal')
                ->add_fields(array(
                    Field::make('text', 'challenge_title', __('Block Title')),
                    Field::make('textarea', 'challenge_description', __('Description')),
                    Field::make('complex', 'challenge_points', __('Pain Points'))
                        ->add_fields(array(
                            Field::make('text', 'point', __('Point'))
                        ))
                ))
                ->set_conditional_logic(array(
                    array(
                        'field' => 'crb_project_details_enabled',
                        'value' => true,
                    )
                )),

            // Our Solution Block
            Field::make('complex', 'crb_project_solution', __('Our Solution'))
                ->set_layout('tabbed-horizontal')
                ->add_fields(array(
                    Field::make('text', 'solution_title', __('Block Title')),
                    Field::make('textarea', 'solution_description', __('Description')),
                    Field::make('complex', 'solution_features', __('Features'))
                        ->add_fields(array(
                            Field::make('text', 'feature_title', __('Feature Title')),
                            Field::make('textarea', 'feature_description', __('Description'))
                        ))
                ))
                ->set_conditional_logic(array(
                    array(
                        'field' => 'crb_project_details_enabled',
                        'value' => true,
                    )
                )),

            // The Results Block
            Field::make('complex', 'crb_project_results', __('The Results'))
                ->set_layout('tabbed-horizontal')
                ->add_fields(array(
                    Field::make('text', 'results_title', __('Block Title')),
                    Field::make('complex', 'results_stats', __('Statistics'))
                        ->add_fields(array(
                            Field::make('text', 'stat_value', __('Value (number only)')),
                            Field::make('text', 'stat_description', __('Description'))
                        ))
                ))
                ->set_conditional_logic(array(
                    array(
                        'field' => 'crb_project_details_enabled',
                        'value' => true,
                    )
                ))
        ))
        ->add_tab(__('Gallery Section'), array(
            Field::make('checkbox', 'crb_project_gallery_enabled', __('Enable Gallery Section')),

            Field::make('text', 'crb_project_gallery_title', __('Section Title'))
                ->set_conditional_logic(array(
                    array(
                        'field' => 'crb_project_gallery_enabled',
                        'value' => true,
                    )
                )),

            Field::make('complex', 'crb_project_gallery_items', __('Gallery Items'))
                ->set_layout('tabbed-horizontal')
                ->add_fields(array(
                    Field::make('image', 'gallery_image', __('Image'))
                        ->set_value_type('url')
                        ->set_required(true),
                    Field::make('text', 'gallery_caption', __('Caption'))
                ))
                ->set_conditional_logic(array(
                    array(
                        'field' => 'crb_project_gallery_enabled',
                        'value' => true,
                    )
                ))
                ->set_header_template('
                    <% if (gallery_caption) { %>
                        <%- gallery_caption %>
                    <% } else { %>
                        Gallery Item #<%- $_index + 1 %>
                    <% } %>
                ')
        ))
        ->add_tab(__('Testimonial Section'), array(
            Field::make('checkbox', 'crb_project_testimonial_enabled', __('Enable Testimonial Section')),

            Field::make('textarea', 'crb_project_testimonial_quote', __('Testimonial Text'))
                ->set_conditional_logic(array(
                    array(
                        'field' => 'crb_project_testimonial_enabled',
                        'value' => true,
                    )
                )),

            Field::make('text', 'crb_project_testimonial_author', __('Author Name'))
                ->set_conditional_logic(array(
                    array(
                        'field' => 'crb_project_testimonial_enabled',
                        'value' => true,
                    )
                )),

            Field::make('text', 'crb_project_testimonial_position', __('Author Position'))
                ->set_conditional_logic(array(
                    array(
                        'field' => 'crb_project_testimonial_enabled',
                        'value' => true,
                    )
                ))
        ))

        // Локальные настройки для проектов

        ->add_tab(__('Project cta Section'), array(
            Field::make('checkbox', 'crb_project_cta_disabled', __('Disable CTA Section for this project'))
        ));
}

add_action('carbon_fields_register_fields', 'about_page_custom_fields');
function about_page_custom_fields()
{
    Container::make('post_meta', 'Настройки страницы "О нас"')
        ->where('post_template', '=', 'templates/about.php') // Применяется только к шаблону about.php
        ->add_fields(array(
            Field::make('text', 'about_page_title', 'Title page')
                ->set_default_value('About Us')
        ))
        ->add_tab('About us story', array(
            Field::make('text', 'about_story_title', 'Title section')
                ->set_default_value('Our Story'),

            Field::make('rich_text', 'about_story_paragraph', 'Paragraph'),

            Field::make('image', 'about_story_image', 'Image')
                ->set_value_type('url'),
        ))
        ->add_tab('Team Section', array(
            Field::make('checkbox', 'team_section_enabled', 'Enable Team Section')
                ->set_option_value('yes'),

            Field::make('text', 'team_section_title', 'Team Section Title')
                ->set_default_value('Meet The Team'),

            Field::make('complex', 'team_members', 'Team Members')
                ->add_fields(array(
                    Field::make('text', 'member_name', 'Name'),
                    Field::make('text', 'member_position', 'Position'),
                    Field::make('image', 'member_photo', 'Photo')
                        ->set_value_type('url')
                        ->set_help_text('Recommended size: 300x300px'),
                    Field::make('textarea', 'member_bio', 'Bio')
                        ->set_rows(3),
                ))
                ->set_layout('tabbed-horizontal')
                ->set_header_template('
            <% if (member_name) { %>
                <%- member_name %>
            <% } else { %>
                Team Member #<%- $_index + 1 %>
            <% } %>
        ')
        ))
        ->add_tab('Values Section', array(
            Field::make('checkbox', 'values_section_enabled', 'Enable Values Section')
                ->set_option_value('yes'),

            Field::make('text', 'values_section_title', 'Values Section Title')
                ->set_default_value('Our Values'),

            Field::make('complex', 'values_list', 'Values List')
                ->add_fields(array(
                    Field::make('image', 'value_icon', 'Icon')
                        ->set_value_type('url')
                        ->set_help_text('Upload an SVG or raster image (recommended SVG for icons)'),
                    Field::make('text', 'value_title', 'Title'),
                    Field::make('textarea', 'value_description', 'Description')
                        ->set_rows(3),
                ))
                ->set_layout('tabbed-horizontal')
                ->set_header_template('
            <% if (value_title) { %>
                <%- value_title %>
            <% } else { %>
                Value #<%- $_index + 1 %>
            <% } %>
        ')
        ));
}

//Contacts
add_action('carbon_fields_register_fields', 'register_contacts_page_fields');
function register_contacts_page_fields()
{
    Container::make('post_meta', 'Contacts Page')
        ->where('post_template', '=', 'templates/contacts.php') // Альтернатива
        ->add_fields(array(
            Field::make('text', 'contacts_title', 'Page Title')
                ->set_default_value("Let's Build Something Great Together"),
            Field::make('text', 'contacts_button_text', 'Button Text')
                ->set_default_value('START NOW'),
            Field::make('text', 'contacts_button_link', 'Button Link (Anchor or URL)')
                ->set_default_value('#feedback'),
        ));
}
add_action('after_setup_theme', 'crb_load');
function crb_load()
{
    require_once('vendor/autoload.php');
    \Carbon_Fields\Carbon_Fields::boot();
}
