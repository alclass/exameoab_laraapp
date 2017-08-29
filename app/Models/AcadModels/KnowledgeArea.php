<?php
namespace App\Models\AcadModels;
// use App\Models\AcadModels\KnowledgeArea;
use App\Models\SabDirModels\SabDirCurso;
use App\Models\SabDirModels\SabDirCursoWithKnowlegdeArea;
/*
  Class KnowledgeAreaFetcher was created to avoid cross importation
  between this class (KnowledgeArea) and class KAreaClosureTable
*/
use App\Models\AcadModels\KnowledgeAreaFetcher;
use Illuminate\Database\Eloquent\Model;

class KnowledgeArea extends Model {

  const ROOTS_PARENT_CONVENTIONED_ID = null;
  const ROOT_CONVENTIONED_ID = 1;


  public static function get_root_knowledge_area() {
    return self::find(self::ROOT_CONVENTIONED_ID);
  }

  private $ka_fetcher = null;  // instance of class KnowledgeAreaFetcher
  protected $table    = 'knowledgeareas';
  protected $fillable = [
    'parent_ka_id', 'name', 'short_description', 'wiki_url',
	];

  public function get_id() {
    return $this->id;
  }

  public function get_parent() {
    if ($this->parent_ka_id == self::ROOTS_PARENT_CONVENTIONED_ID) {
      // in this case, $this here is root (self::get_root_knowledge_area()_
      // root's parent is null by convention
      return null;
    }
    $parent_ka = self::find($this->parent_ka_id);
    return $parent_ka;
  }

  public function set_ka_fetcher_once() {
    if ($this->ka_fetcher != null) {
      return;
    }
    $this->ka_fetcher = new KnowledgeAreaFetcher($this, self::ROOT_CONVENTIONED_ID);
  }

  public function get_siblings() {
    // siblings (brothers and sisters) are knowledge areas at the same depth
    $this->set_ka_fetcher_once();
    return $this->ka_fetcher->get_siblings();
  }

  public function fetch_level_knowledge_areas_as_ids($n_level=1) {
    $this->set_ka_fetcher_once();
    return $this->ka_fetcher->fetch_level_knowledge_areas_as_ids($n_level);
  }

  public function fetch_level_knowledge_areas_as_objs($n_level=1) {
    $this->set_ka_fetcher_once();
    return $this->ka_fetcher->fetch_level_knowledge_areas_as_objs($n_level);
  }

  public function fetch_path_from_root_to_karea_as_ids() {
    $this->set_ka_fetcher_once();
    return $this->ka_fetcher->fetch_path_from_root_to_karea_as_ids($this->id);
  }

  public function fetch_path_from_root_to_karea_as_objs() {
    $this->set_ka_fetcher_once();
    return $this->ka_fetcher->fetch_path_from_root_to_karea_as_objs($this->id);
  }

  public function fetch_path_from_root_to_kareaparent_as_objs() {
    $this->set_ka_fetcher_once();
    return $this->ka_fetcher->fetch_path_from_root_to_kareaparent_as_objs($this->id);
  }

  public function fetch_subtree_knowledge_areas_as_ids() {
    $this->set_ka_fetcher_once();
    return $this->ka_fetcher->fetch_subtree_knowledge_areas_as_ids($this->id);
  }

  public function fetch_subtree_knowledge_areas_as_objs() {
    $this->set_ka_fetcher_once();
    return $this->ka_fetcher->fetch_subtree_knowledge_areas_as_objs($this->id);
  }

  public function count_n_courses_under_subtree_knowledge_areas() {
    $ids = $this->fetch_subtree_knowledge_areas_as_ids();
    return SabDirCursoWithKnowlegdeArea
      ::whereIn('knowledgearea_id', $ids)
      ->count();
  }

  public function fetch_courses_under_subtree_knowledge_areas() {
    $ids = $this->fetch_subtree_knowledge_areas_as_ids();
    $course_ids = [];
    $sabdircurso_n_knowledgearea_rows = SabDirCursoWithKnowlegdeArea
      ::whereIn('knowledgearea_id', $ids)->get();
    foreach ($sabdircurso_n_knowledgearea_rows as $sabdircurso_n_knowledgearea_row) {
      $course_ids[] = $sabdircurso_n_knowledgearea_row->sabdircurso_id;
    }
    return SabDirCurso::find($course_ids);
  }

  public function parent_knowledge_area() {
    return $this->belongsTo('App\Models\Acad\KnowledgeArea', 'parent_ka_id');
  }

} // ends class KnowledgeArea extends Model

/*
  These 2 commented-out methods belong to the old strategy to
  maintain paths and subtree, when they were the following two fields:
      // 'slash_sep_path_from_root_to_node',
      // 'slash_sep_list_encompassing_subtree',

  These were retired after introducing the Closure Table technique.


  public function get_uptree_knowledge_areas() {
    $slash_sep_ids = $this->knowledgearea_slash_sep_pathids;
    if ($slash_sep_ids == null) {
      return [];
    }
    $ids = explode('/', $slash_sep_ids);
    // CHECK if it's necessary to convert string to int here !!! (ids each will string above)
    $uptree_knowledge_areas = KnowledgeArea::find($ids);
    return $uptree_knowledge_areas;
  }

  public function get_knowledge_area_namepath($sep = '/') {
    $uptree_knowledge_areas = $this->get_uptree_knowledge_areas();
    $names = [];
    foreach ($uptree_knowledge_areas as $uptree_knowledge_area) {
      $names[] = $uptree_knowledge_area->name;
    }
    $namepath = join($sep, $names);
    return $namepath;
  }
*/
