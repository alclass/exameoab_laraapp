<?php
namespace App\Models\AcadModels;
// use App\Models\AcadModels\KnowledgeAreaFetcher;

use App\Models\AcadModels\KAreaClosureTable;
use App\Models\AcadModels\KAreaClosureTableFetcher;
use Illuminate\Database\Eloquent\Model;

class KnowledgeAreaFetcher {
  /*
    Class KnowledgeAreaFetcher was created to avoid cross importation
    between class (KnowledgeArea) and class KAreaClosureTable
  */
  public $id = null;
  public $knowledge_area = null;

  public function __construct($knowledge_area, $root_conventioned_id) {
    $this->knowledge_area = $knowledge_area;
    $this->id             = $knowledge_area->id;
    $this->root_conventioned_id = $root_conventioned_id;
  }

  public function get_siblings() {
    // siblings (brothers and sisters) are knowledge areas at the same depth
    if ($this->id == $this->root_conventioned_id) {
      return null;
    }
    $closure_table_row = KAreaClosureTable
      ::where('parent_id', $this->root_conventioned_id)
      ->where('child_id', $this->id)->get('depth');
    if ($closure_table_row == null) {
      return null;
    }
    return KAreaClosureTableFetcher
      ::fetch_level_knowledge_areas_as_objs($closure_table_row->depth);
  }

  public function fetch_level_knowledge_areas_as_ids($n_level=1) {
    return KAreaClosureTableFetcher::fetch_level_knowledge_areas_as_ids($n_level);
  }

  public function fetch_level_knowledge_areas_as_objs($n_level=1) {
    return KAreaClosureTableFetcher::fetch_level_knowledge_areas_as_objs($n_level);
  }

  public function fetch_path_from_root_to_karea_as_ids() {
    return KAreaClosureTableFetcher::fetch_path_from_root_to_karea_as_ids($this->id);
  }

  public function fetch_path_from_root_to_karea_as_objs() {
    return KAreaClosureTableFetcher::fetch_path_from_root_to_karea_as_objs($this->id);
  }

  public function fetch_path_from_root_to_kareaparent_as_objs() {
    return KAreaClosureTableFetcher::fetch_path_from_root_to_kareaparent_as_objs($this->id);
  }

  public function fetch_subtree_knowledge_areas_as_ids() {
    return KAreaClosureTableFetcher::fetch_subtree_knowledge_areas_as_ids($this->id);
  }

  public function fetch_subtree_knowledge_areas_as_objs() {
    return KAreaClosureTableFetcher::fetch_subtree_knowledge_areas_as_objs($this->id);
  }

} // ends class KnowledgeAreaFetcher
