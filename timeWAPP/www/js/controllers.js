angular.module('app.controllers', [])

    .filter('removeHTMLTags', function () {
        return function (text) {
            return text ? String(text).replace(/<[^>]+>/gm, '') : '';
        }
    })

    .controller('clientsCtrl', ['$scope', '$http', '$stateParams', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
// You can include any angular dependencies as parameters for this function
// TIP: Access Route Parameters for your page via $stateParams.parameterName
        function ($scope, $http, $stateParams) {
            $scope.clients = [];
            $http.get('http://dho.igniters.dk/wp-json/wp/v2/clients')
                .then(function successCallback(response) {
                    // this callback will be called asynchronously
                    // when the response is available
                    // set clients[] to response.data (data is the arrays of data within the response object).
                    $scope.clients = response.data;
                }, function errorCallback(response) {
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                    alert('ERROR!\n' + response);
                });
        }])

    .controller('projectsCtrl', ['$scope', '$http', '$stateParams', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
// You can include any angular dependencies as parameters for this function
// TIP: Access Route Parameters for your page via $stateParams.parameterName
        function ($scope, $http, $stateParams) {
            $scope.projects = [];
            $http.get('http://dho.igniters.dk/wp-json/wp/v2/projects')
                .then(function successCallback(response) {
                    // this callback will be called asynchronously
                    // when the response is available
                    // set clients[] to response.data (data is the arrays of data within the response object).
                    $scope.projects = response.data;
                }, function errorCallback(response) {
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                    alert('ERROR!\n' + response);
                });
        }])

    .controller('singleProjectCtrl', ['$scope', '$http', '$stateParams', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
// You can include any angular dependencies as parameters for this function
// TIP: Access Route Parameters for your page via $stateParams.parameterName
        function ($scope, $http, $stateParams) {

            $scope.project = [];
            $scope.times = [];
            $scope.project_times = [];
            $http.get('http://dho.igniters.dk/wp-json/wp/v2/projects/' + $stateParams.projectId)
                .then(function successCallback(response) {
                    // this callback will be called asynchronously
                    // when the response is available
                    // set clients[] to response.data (data is the arrays of data within the response object).
                    $scope.project = response.data;

                    // GET all time-registrations.
                    $http.get('http://dho.igniters.dk/wp-json/wp/v2/time-registrations')
                        .then(function successCallback(response) {
                            // Set $scope.times equal to response.data.
                            $scope.times = response.data;
                            // forEach $scope.times, do this.
                            angular.forEach($scope.times, function (value, key) {
                                // If ID of value equals $scope.project.id, then add time to $scope.project_times.
                                if (value.acf.choose_project.ID == $scope.project.id) {
                                    $scope.project_times.push(value);
                                }
                            })

                        }, function errorCallback(response) {
                            alert('ERROR!\n' + response)
                        });

                }, function errorCallback(response) {
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                    alert('ERROR!\n' + response);
                });

        }])

    .controller('registerTimeCtrl', ['$scope', '$stateParams', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
// You can include any angular dependencies as parameters for this function
// TIP: Access Route Parameters for your page via $stateParams.parameterName
        function ($scope, $stateParams) {


        }])

    .controller('menuCtrl', ['$scope', '$stateParams', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
// You can include any angular dependencies as parameters for this function
// TIP: Access Route Parameters for your page via $stateParams.parameterName
        function ($scope, $stateParams) {


        }])

    .controller('loginCtrl', ['$scope', '$stateParams', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
// You can include any angular dependencies as parameters for this function
// TIP: Access Route Parameters for your page via $stateParams.parameterName
        function ($scope, $stateParams) {


        }])
 