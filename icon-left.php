<?php

add_action( 'vc_before_init', 'primaria_icon_left_admin' );
function primaria_icon_left_admin() {
  vc_map(
    array(
      "name" => __( "Блок с иконкой с лева", "primaria" ),
      "base" => "primaria_icon_left",
      "params" => array(
        array(
          "type" => "attach_image",
          "heading" => "Иконка",
          "param_name" => "icon_id",
          "description" => "Выберите изображение иконки"
        ),
        array(
          "type" => "textfield",
          "class" => "",
          "heading" => __( "Иконка", "primaria" ),
          "param_name" => "icon",
          "value" => "",
          "description" => __( "Иконка fontawesome", "primaria" )
        ),
        array(
          "type" => "dropdown",
          "class" => "",
          "heading" => __( "Тип", "primaria" ),
          "param_name" => "type",
          "value" => array('fas','far','fal','fad'),
          "description" => __( "Тип иконки fontawesome", "primaria" )
        ),
        array(
          "type" => "textfield",
          "class" => "",
          "heading" => __( "Заголовок", "primaria" ),
          "param_name" => "title",
          "value" => "",
          "description" => __( "Введите заголовок", "primaria" )
        ),
        array(
          "type" => "textarea_html",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Содержимое", "primaria" ),
          "param_name" => "content",
          "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "primaria" ),
          "description" => __( "Введите содержимое.", "primaria" )
        )
      )
    )
  );
}



add_shortcode( 'primaria_icon_left', 'primaria_icon_left_func' );
function primaria_icon_left_func( $atts, $content = null ) {
 extract( shortcode_atts( array(
  'icon_id' => '',
  'icon' => 'fa-address-book',
  'type' => 'far',
  'title' => '',
 ), $atts ) );

// print_r($atts);

$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content 

$image_url = wp_get_attachment_image_src($icon_id, 'full');
$image_url = $image_url[0];


if( isset($atts['icon_id']) ) {
  $icon = "<div class='icon-left__icon-wrap'><img class='icon-left__icon' src='{$image_url}'></div>";
} else {
  $icon = "<div class='icon-left__icon-wrap'><i class='" . $atts['type'] . " " . $atts['icon'] . "'></i></div>";
}

if($atts['title']) {
  $title = "<div class='icon-left__title'>" . $atts['title'] . "</div>";
}

 return "<div class='icon-left'>
  {$icon}
  <div class='icon-left__text'>
    {$title}
    <div class='icon-left__content'>{$content}</div>
  </div>
  
</div>";
}
