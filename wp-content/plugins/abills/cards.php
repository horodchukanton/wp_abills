<?php

class Abills_Card {

  protected static $id = 0;

  var $this_id;
  var $img;
  var $abstract;

  var $title;
  var $text;

  var $link;

  var $mdSize;
  var $xsSize;

  private $asString;

  /**
   * Abills_Cards_Builder constructor.
   * @param $img
   * @param $abstract
   * @param $title
   * @param $text
   * @param $link
   * @param $mdSize
   * @param $xsSize
   */
  public function __construct($img, $abstract, $title, $text, $link, $mdSize, $xsSize) {
    $this->this_id = $this::$id++;

    $this->img = $img;
    $this->abstract = $abstract;
    $this->title = $title;
    $this->text = $text;
    $this->link = $link;
    $this->mdSize = $mdSize;
    $this->xsSize = $xsSize;

    $this->Build();
  }

  public function __toString() {
    return $this->asString;
  }

  /**
   * @return string
   */
  public function Build() {

    $result = "<div class='col-md-$this->mdSize col-xs-$this->xsSize'><div class='card'>";

    if (isset($this->img)) {
      $result .= "<div class='card-image'>";
      $result .= "<img class=\"img-responsive\" src=\"$this->img\">";
      $result .= "</div>";
    } else if (isset($this->abstract)) {
      $result .= "<div class='card-image'>";
      $result .= "<img class=\"img-responsive\" src=\"http://lorempixel.com/640/300/abstract\">";
      $result .= "</div>";
    }

    $result .= '<div class="card-content">';
    if (isset($this->title)) {
      $result .= "<span class='card-title'>$this->title</span>";

      if (isset($this->text)) {
        $result .= "<button type=\"button\" class=\"btn btn-custom pull-right card-more-btn\" aria-label=\"Left Align\"><i class=\"fa fa-ellipsis-v\"></i></button>";
      }
    }
    $result .= '</div>';

    if (isset($this->link)) {
      $result .= "<div class=\"card-action\">";
      if (is_array($this->link)) {
        foreach ($this->link as $url => $name) {
          $result .= "<a href='$url'>$name</a>";
        }
      } else {
        $result .= "<a target=\"new_blank\" href='$this->link'>Подробнее</a>";
      }
      $result .= "</div>";
    }

    if (isset($this->text)) {
      $result .= "<div class=\"card-reveal\">";
      if (isset($this->title)) {
        $result .= "<span class=\"card-title\">$this->title</span>";
      }
      $result .= "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span>
          </button>
          <p>$this->text</p>
        </div>";
    }

    $result .= '</div></div>';

    $this->asString = $result;
  }
}

add_action('abills_cards', function ($list_name) {

  $list_stringified = abills_get_custom_option('abills_exported_' . $list_name);

  if (!$list_stringified) {
    echo " [ ABillS Cards ] List $list_name not found \n";
    return false;
  }

  $list = json_decode($list_stringified, true);

  foreach ($list as &$list_item) {
    $list_item['img'] = isset($list_item['img'] ) ? $list_item['img']  : null;
    $list_item['title'] = isset($list_item['title'] ) ? $list_item['title']  : null;
    $list_item['text'] = isset($list_item['text'] ) ? $list_item['text']  : null;
    $list_item['link'] = isset($list_item['link'] ) ? $list_item['link']  : null;

    echo new Abills_Card(
      $list_item['img'],
      ($list_item['img']) ? null : true,
      $list_item['title'],
      $list_item['text'],
      $list_item['link'],
      6, 12
    );
  }
  return true;
});


?>
