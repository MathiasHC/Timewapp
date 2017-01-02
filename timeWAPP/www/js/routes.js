// www/app.js

    angular
        .module('app.routes', ['ionic', 'angular-jwt'])
        .config(config);

    config.$inject = ['$stateProvider', '$urlRouterProvider', 'jwtOptionsProvider'];

    function config($stateProvider, $urlRouterProvider, jwtOptionsProvider) {
        $stateProvider

        // setup an abstract state for the tabs directive
            .state('tabsController.clients', {
                url: '/page2',
                views: {
                    'tab1': {
                        templateUrl: 'templates/clients.html',
                        controller: 'clientsCtrl'
                    }
                }
            })

            .state('tabsController.projects', {
                url: '/page3',
                views: {
                    'tab2': {
                        templateUrl: 'templates/projects.html',
                        controller: 'projectsCtrl'
                    }
                }
            })

            .state('tabsController.singleProject', {
                url: '/page5/:projectId',
                views: {
                    'tab2': {
                        templateUrl: 'templates/singleProject.html',
                        controller: 'singleProjectCtrl'
                    }
                }
            })

            .state('tabsController.registerTime', {
                url: '/page4',
                views: {
                    'tab3': {
                        templateUrl: 'templates/registerTime.html',
                        controller: 'registerTimeCtrl'
                    }
                }
            })

            .state('tabsController', {
                url: '/page1',
                templateUrl: 'templates/tabsController.html',
                abstract: true
            })

            .state('login', {
                url: '/page_login',
                templateUrl: 'templates/login.html',
                controller: 'loginCtrl'
            });

        // if none of the above states are matched, use this as the fallback
        $urlRouterProvider.otherwise('/page1/page3');

        // Configuration for angular-jwt
        jwtOptionsProvider.config({
            tokenGetter: function () {
                return localStorage.getItem('id_token');
            },
            whiteListedDomains: ['localhost'],
            unauthenticatedRedirectPath: '/login'
        });

    }
