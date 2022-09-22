<?php
namespace App\Repositories\Sqlite;

use App\Model\Article;
use App\Repository\ArticleRepositoryInterface;



class ArticleRepository extends SqliteRepository implements ArticleRepositoryInterface
{
    /**
    * ArticleRepository constructor.
    *
    * @param Article $model
    */
   public function __construct(Article $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();    
   }
}