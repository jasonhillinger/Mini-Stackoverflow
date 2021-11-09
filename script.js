var app = angular.module("myModule", [])
    .controller("myController", function($scope) {

        var members = [
            { name: "", Votes: 0 },

        ];

        $scope.members = members;

        $scope.incrementUp = function(member) {
            member.Votes++;
        }
        $scope.incrementDown = function(member) {
            member.Votes--;
        }
    });
    
