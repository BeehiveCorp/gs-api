<?php

class ProductController {
  private $ProductRepository;

  function __construct() {
    $database = new Database("database", "nutriaapp", "root", "nutriaapp");
    $connection = $database->getConnection();

    $this->ProductRepository = new ProductRepository($connection);
  }

  public function getAll(Request $request) {
    $body = $request->body;
    $missingNutrientIds = $body->missingNutrientIds;
    $ids = strval(implode(',', $missingNutrientIds));

    $sql = 'SELECT DISTINCT p.* FROM PRODUCTS p
              INNER JOIN PRODUCT_CATEGORIES pc
              ON p.product_category_id = pc.id
                  INNER JOIN PRODUCT_CATEGORY_NUTRIENTS pcn
                  ON pc.id = pcn.product_category_id
                      WHERE pcn.nutrient_id IN (' . $ids . ')';

    $all = $this->ProductRepository::sql($sql);
    ResponseHandler::success(200, $all);
  }

  public function getByStore(Request $request) {
    $params = $request->params;
    $storeId = $params->id;

    $all = $this->ProductRepository::where('store_id = ' . "'$storeId'");
    ResponseHandler::success(200, $all);
  }
}