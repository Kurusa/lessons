<?php
require_once('Database.php');
$db = new DataBase();

$db->select(['id'], 'dishes', []);
$dishesCount = $db->numRows();

$db->select(['id'], 'moderateRecipe', []);
$moderateCount = $db->numRows();
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <script src="https://use.fontawesome.com/8aa4ff900d.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
            integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
            crossorigin="anonymous"></script>

</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="#">Cooker UI</a>
</nav>

<div class="row" ng-app="myApp" ng-controller="myCtrl">
    <div class="col-2">
        <div class="list-group" id="list-tab">
            <a class="list-group-item list-group-item-action" id="dishesList"
               data-toggle="list" href="#list-profile" role="tab">Страви
                <span class="badge badge-primary badge-pill"><?= $dishesCount ?></span> </a>
            <a class="list-group-item list-group-item-action" id="list-messages-list"
               data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Рецепти на модерацію
                <span class="badge badge-primary badge-pill"><?= $moderateCount ?></span>
            </a>
            <button type="button" class="btn btn-primary" ng-click="newRecipe()">Новий рецепт</button>
        </div>
    </div>

    <div class="col-2" id="notRecipeMode">
        <div class="tab-pane fade show active" id="list-profile" role="tabpanel">
            <div class="list-group">
                <a ng-repeat="title in dishTypeName" class="list-group-item list-group-item-action" data-toggle="list"
                   role="tab"
                   ng-click="showDishes(title.id)">{{title.dishTypeName}}</a>
            </div>
        </div>
        <div class="tab-pane fade" id="list-messages" role="tabpanel">BLaBLaBLaBLaBLa</div>
    </div>

    <!--NEW RECIPE-->
    <div ng-if="recipeMode" class="col-2">
        <div class="tab-pane fade show active" id="list-profile" role="tabpanel">
            <div class="list-group">
                <a ng-repeat="title in dishTypeName" class="list-group-item list-group-item-action" data-toggle="list"
                   role="tab"
                   ng-click="selectDishTypeID(title.id)">{{title.dishTypeName}}</a>
            </div>
        </div>
    </div>

    <div ng-if="showDishTitle">
        <div class="form-group">
            <label for="showDishTitle">Введіть назву нової страви</label>
            <textarea class="form-control" id="showDishTitle" aria-describedby="showDishTitle"
                      ng-model="recipeTitle"> </textarea>
            <button type="button" class="btn btn-primary" ng-click="insertNewDishTitle(recipeTitle)">Готово</button>
        </div>
    </div>

    <div ng-if="cookingTime">
        <div class="form-group">
            <label for="cookingTime">Скільки часу займає приготування?</label>
            <textarea class="form-control" id="cookingTime" aria-describedby="cookingTime"
                      ng-model="cookingTime"> </textarea>
        </div>
        <button type="button" class="btn btn-primary" ng-click="insertCookingTime(cookingTime)">Готово</button>
    </div>

    <div ng-if="showIngredients">
        <div class="form-group">
            <label for="showIngredients">Введіть інгредієнти</label>

            <div class="ingFields" ng-repeat="eachItem in ings track by $index">
                <input class="form-control showIngredients" aria-describedby="showIngredients" ng-model="eachItem">
                <div style="float: right;">
                    <i ng-click="cloneRow(eachItem)" style="cursor: pointer" class="fa fa-plus-square"
                       aria-hidden="true"></i>
                </div>
            </div>

        </div>
        <button type="button" class="btn btn-primary" ng-click="insertIng()">Готово</button>
    </div>

    <div ng-if="showSteps">
        <div class="form-group">
            <label for="showSteps">Введіть кроки</label>

            <div class="stepFields" ng-repeat="data in steps">
                <input class="form-control showSteps" aria-describedby="showSteps" ng-model="data.step">
                <input class="form-control showTime" aria-describedby="showTime" ng-model="data.time">
                <div style="float: right">
                    <i ng-click="cloneStepRow()" style="cursor: pointer" class="fa fa-plus-square"
                       aria-hidden="true"></i>
                    <i ng-click='removeItem($item)' class="fa fa-ban"></i>
                </div>
            </div>

        </div>
        <button type="button" class="btn btn-primary" ng-click="insertStep()">Готово</button>
    </div>


    <div ng-if="showImage">
        <div class="form-group">
            <label for="showImage">Image URL</label>
            <input class="form-control" id="showImage" aria-describedby="showImage" ng-model="imageURL">
            <button type="button" class="btn btn-primary" ng-click="insertImageURL(imageURL)">Готово</button>
        </div>
    </div>

    <!--NEW RECIPE-->

    <div class="col-3">
        <div class="tab-pane fade show active" id="list-profile" role="tabpanel">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action" data-toggle="list" role="tab"
                   ng-repeat="title in dishTitle" ng-click="showRecipe(title.recipe)">
                    {{title.dishTitle}}
                </a>
            </div>
            <button type="button" class="btn btn-success" id="sendArray" ng-click="sendArray()" style="width: 100%">
                Готово
            </button>

        </div>

        <div>
            <div style="float: left;" class="list-group col-5">
                <hr>
                <div ng-repeat="desc in info.ingredients">
                    <a href="#" class="list-group-item list-group-item-action ng-binding ng-scope" id="ingredients">{{desc}}</a>

                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-secondary active" ng-click="ingEdit($index, desc)">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </label>
                        <label class="btn btn-secondary" ng-click="ingDelete(desc)">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </label>
                    </div>
                </div>
            </div>

            <div id="list-profile" role="tabpanel" class=" tab-pane fade show active">
                <div class="list-group" id="steps">
                    <hr>
                    <div ng-repeat="desc in info.steps">
                        <a href="#" class="list-group-item list-group-item-action ng-binding ng-scope" id="steps">{{desc}}</a>

                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-secondary active" ng-click="stepEdit($index, desc)">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </label>
                            <label class="btn btn-secondary" ng-click="stepDelete(desc)">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Step Modal -->
    <div class="modal fade" id="stepModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <textarea class="modal-body" ng-model="editStep"></textarea>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" ng-click="stepSave()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Ing Modal -->
    <div class="modal fade" id="ingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <textarea class="modal-body" ng-model="editIng"></textarea>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" ng-click="ingSave()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var fetch = angular.module('myApp', []);

    fetch.controller('myCtrl', ['$scope', '$http', function ($scope, $http) {
        $scope.info = [];

        $scope.dishTypeName = "";
        $scope.id = 0;

        $scope.dishTitle = "";
        $scope.recipe = "";

        $scope.editStep = "";
        $scope.editIndex = 0;

        $scope.editIng = '';
        $scope.ingEditIndex = 0;

        //------NEW RECIPE
        $scope.recipeArray = {};

        $scope.recipeMode = false;
        $scope.showDishTitle = false;
        $scope.cookingTime = false;
        $scope.showIngredients = false;
        $scope.showSteps = false;
        $scope.showImage = false;

        $http.post(
            'ajaxActions.php',
            $.param({
                action: 'getDishesType'
            }),
            {headers: {'Content-Type': 'application/x-www-form-urlencoded'}}
        ).then(function successCallback(response) {
            $scope.dishTypeName = response.data;
            $scope.id = response.id;
        });

        $scope.showDishes = function (id) {
            $http.post(
                'ajaxActions.php',
                $.param({
                    action: 'getDishesTitle',
                    typeID: id
                }),
                {headers: {'Content-Type': 'application/x-www-form-urlencoded'}}
            ).then(function successCallback(response) {
                $scope.dishTitle = response.data;
                $scope.recipe = response.recipe;
            });
        };

        $scope.showRecipe = function (JSONrecipe) {
            $scope.info = JSON.parse(JSONrecipe);
        };

        $scope.ingDelete = function (text) {
            var index = $scope.info.ingredients.indexOf(text);
            if (index > -1) {
                $scope.info.ingredients.splice(index, 1);
            }
        };

        $scope.stepDelete = function (text) {
            var index = $scope.info.steps.indexOf(text);
            if (index > -1) {
                $scope.info.steps.splice(index, 1);
            }
        };

        $scope.stepEdit = function (index, text) {
            $("#stepModal").modal('show');
            $scope.editStep = text;
            $scope.editIndex = index;
        };

        $scope.ingEdit = function (index, text) {
            $("#ingModal").modal('show');
            $scope.editIng = text;
            $scope.ingEditIndex = index;
        };

        $scope.ingSave = function () {
            $scope.info.ingredients[$scope.ingEditIndex] = $scope.editIng;
            $("#ingModal").modal('hide');
        };

        $scope.stepSave = function () {
            $scope.info.steps[$scope.editIndex] = $scope.editStep;
            $("#stepModal").modal('hide');
        };

        $scope.sendArray = function () {
            $http.post(
                'ajaxActions.php',
                $.param({
                    action: 'updateArray',
                    array: JSON.stringify($scope.info),
                    dishName: $scope.info.name
                }),
                {headers: {'Content-Type': 'application/x-www-form-urlencoded'}}
            )
        };

        $scope.newRecipe = function () {
            $scope.recipeMode = true;
            $("#notRecipeMode").css('display', 'none');
            $("#sendArray").css('display', 'none');
        };

        $scope.selectDishTypeID = function (dishTypeID) {
            $http.post(
                'ajaxActions.php',
                $.param({
                    action: 'newDishType',
                    typeID: dishTypeID
                }),
                {headers: {'Content-Type': 'application/x-www-form-urlencoded'}}
            ).then(function successCallback() {
                $scope.recipeMode = false;
                $scope.showDishTitle = true;
            });
        };

        $scope.insertNewDishTitle = function (recipeTitle) {
            $http.post(
                'ajaxActions.php',
                $.param({
                    action: 'newDishTitle',
                    recipeTitle: recipeTitle
                }),
                {headers: {'Content-Type': 'application/x-www-form-urlencoded'}}
            ).then(function successCallback() {
                $scope.showDishTitle = false;
                $scope.cookingTime = true;
                $scope.recipeArray['name'] = recipeTitle;
            });
        };

        $scope.insertCookingTime = function (cookingTime) {
            $scope.recipeArray['cookingTime'] = cookingTime;
            $scope.cookingTime = false;
            $scope.showIngredients = true;
        };

        $scope.ings = [''];

        $scope.cloneRow = function (field) {
            $scope.ings.push(angular.copy(field));
        };

        $scope.insertIng = function () {
            $scope.recipeArray['ingredients'] = $scope.ings;
            $scope.showIngredients = false;
            $scope.showSteps = true;
        };



        $scope.steps = [{
                "step": "",
                "time": ""
            }];

        $scope.cloneStepRow = function () {
            var itemToClone = { "step": "", "time": "" };
            $scope.steps.push(itemToClone);
        };

        $scope.removeItem = function (itemIndex) {
            $scope.steps.splice(itemIndex, 1);
        };

        /////////?!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $scope.insertStep = function () {
        /////////?!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

            $scope.recipeArray['steps'] = $scope.steps;
            $scope.showSteps = false;
            $scope.showImage = true;
            console.log($scope.recipeArray);
        };

        $scope.insertImageURL = function (url) {
            $http.post(
                'ajaxActions.php',
                $.param({
                    action: 'insertWholeRecipe',
                    array: JSON.stringify($scope.recipeArray),
                    imageURL: url
                }),
                {headers: {'Content-Type': 'application/x-www-form-urlencoded'}}
            ).then(function successCallback() {
                $scope.showImage = false;
            });
        };
    }])
</script>
</body>
</html>