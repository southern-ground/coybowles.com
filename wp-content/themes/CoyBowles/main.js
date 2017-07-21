(function () {
  'use strict';

  angular
    .module('CoyApp', [])
    .controller('MainCtrl', MainCtrl)
    .directive('cbScroll', function ($window) {
      return {
        scope: {
          ctrl: '='
        },
        link: function(scope, element, attrs) {
          angular.element($window).bind('scroll', function() {
            if (this.pageYOffset >= 500) {
              scope.ctrl.navCollapsed = true;
              angular.element($window).unbind('scroll');
            }
            scope.$apply();
          });
        }
      };
    })
    .filter('truncate', function () {
            return function (input, chars, breakOnWord) {
                if (isNaN(chars)) return input;
                if (chars <= 0) return '';
                if (input && input.length > chars) {
                    input = input.substring(0, chars);

                    if (!breakOnWord) {
                        var lastspace = input.lastIndexOf(' ');
                        //get last space
                        if (lastspace !== -1) {
                            input = input.substr(0, lastspace);
                        }
                    }else{
                        while(input.charAt(input.length-1) === ' '){
                            input = input.substr(0, input.length -1);
                        }
                    }
                    return input + '…';
                }
                return input;
            };
        });

  MainCtrl.$inject = ['$sce', '$scope', '$http'];
  function MainCtrl($sce, $scope, $http) {
    var vm = this;

    vm.window = window;

    if(window.screen.width < 990) {
      vm.navCollapsed = true;
      vm.expandedOpen = 1;
      vm.expandedAmpOpen = 1;
      vm.expandedPedalOpen = 1;
    }

    // HOME PAGE
    if(window.location.href.indexOf('openVideos') > -1) {
      vm.feedExpanded = true;
    } else {
      vm.feedExpanded = false;
    }

    vm.currentVideoSrc = '';

    vm.currentFeed = 'video';

    vm.mainPage = 0;
    vm.miniPage = 0;

    vm.videos = [];

    vm.posts = [];

    vm.showVideo = showVideo;
    vm.hideExpanded = hideExpanded;
    vm.changeFeed = changeFeed;

    vm.fbThing = fbThing;
    vm.fbLink = fbLink;

    vm.setYtPlaylist = setYtPlaylist;
    vm.getFirstPlaylistItem = getFirstPlaylistItem;

    vm.nextMainPage = nextMainPage;
    vm.prevMainPage = prevMainPage;

    vm.nextMiniPage = nextMiniPage;
    vm.prevMiniPage = prevMiniPage;

    vm.nextGuitarPage = nextGuitarPage;
    vm.prevGuitarPage = prevGuitarPage;

    vm.nextPedalPage = nextPedalPage;
    vm.prevPedalPage = prevPedalPage;

    vm.prevMiniGuitarPage = prevMiniGuitarPage;
    vm.nextMiniGuitarPage = nextMiniGuitarPage;

    function setYtPlaylist(playlistId) {
      vm.ytPlaylist = playlistId;
      ytThing();
    }

    function prevMiniGuitarPage(e) {
      var current = $(e.target).parent().find('.guitar_img.current');

      if(current.hasClass('amp')) {
        if(current.prev().prev().prev('.guitar_img').length > 0) {
          current.removeClass('current');
          current.prev().prev().prev('.guitar_img').addClass('current');
        }
      } else {
        if(current.prev().prev().prev().prev('.guitar_img').length > 0) {
          current.removeClass('current');
          current.prev().prev().prev().prev('.guitar_img').addClass('current');
        }
      }
    }

    function nextMiniGuitarPage(e) {
      var current = $(e.target).parent().find('.guitar_img.current');

      if(current.hasClass('amp')) {
        if(current.next().next().next('.guitar_img').length > 0) {
          current.removeClass('current');
          current.next().next().next('.guitar_img').addClass('current');
        }
      } else {
        if(current.next().next().next().next('.guitar_img').length > 0) {
          current.removeClass('current');
          current.next().next().next().next('.guitar_img').addClass('current');
        }
      }
    }

    function nextPedalPage() {
      var children = $('.guitar_expanded .resto_images:visible.pedal .page').children(),
          page = $('.guitar_expanded .resto_images:visible.pedal .page'),
          totalWidth = children.length * children.width(),
          pageWidth = page.width(),
          difference = totalWidth + page.position().left;

      if(difference > pageWidth) vm.pedalPage = vm.pedalPage + 1;
    }

    function prevPedalPage() {
      if ($('.guitar_expanded .resto_images:visible.pedal .page').position().left >= 0) return false;
      vm.pedalPage = vm.pedalPage - 1;
    }

    function nextGuitarPage() {
      var children = $('.guitar_expanded .resto_images:visible.guitar .page').children(),
          page = $('.guitar_expanded .resto_images:visible.guitar .page'),
          totalWidth = children.length * children.width(),
          pageWidth = page.width(),
          difference = totalWidth + page.position().left;

      if(difference > pageWidth) vm.guitarPage = vm.guitarPage + 1;
    }

    function prevGuitarPage() {
      if ($('.guitar_expanded .resto_images:visible.guitar .page').position().left >= 0) return false;
      vm.guitarPage = vm.guitarPage - 1;
    }

    function nextMiniPage() {
      var children = $('.mini_feed:visible .page').children(),
          page = $('.mini_feed:visible .page'),
          totalWidth = children.length * children.width(),
          pageWidth = page.width(),
          difference = totalWidth + page.position().left;

      if(difference > pageWidth) vm.miniPage = vm.miniPage + 1;
    }

    function prevMiniPage() {
      if ($('.mini_feed:visible .page').position().left >= 0) return false;
      vm.miniPage = vm.miniPage - 1;
    }

    function nextMainPage() {
      var children = $('.section.feed:visible .page').children(),
          page = $('.section.feed:visible .page'),
          totalWidth = children.length * children.width(),
          pageWidth = page.width(),
          difference = totalWidth + page.position().left;

      if(difference > pageWidth) vm.mainPage = vm.mainPage + 1;
    }

    function prevMainPage() {
      if ($('.section.feed:visible .page').position().left >= 0) return false;
      vm.mainPage = vm.mainPage - 1;
    }

    function ytThing() {
      $http({
        method: 'GET',
        url: 'https://www.googleapis.com/youtube/v3/playlistItems',
        params: {
          key: 'AIzaSyD0qTpSoLSz3tjrxDEp7faQHzyIQSkcAPs',
          part: 'snippet',
          playlistId: vm.ytPlaylist
        }
      }).then(_success);

      function _success(resp) {
        var data = resp.data.items;

        for(var i=0; i<data.length; i++) {
          vm.videos.push({
            title: data[i]['snippet']['title'],
            id: data[i]['snippet']['resourceId']['videoId']
          });
        }

        if(vm.feedExpanded) {
          vm.showVideo(vm.videos[0].id);
        }
      }
    }

    function getFirstPlaylistItem(key, playlistId) {
      $http({
        method: 'GET',
        url: 'https://www.googleapis.com/youtube/v3/playlistItems',
        params: {
          key: 'AIzaSyD0qTpSoLSz3tjrxDEp7faQHzyIQSkcAPs',
          part: 'snippet',
          maxResults: 1,
          playlistId: playlistId
        }
      }).then(_success);

      function _success(resp) {
        var data = resp.data.items;
        vm['video-' + key] = {
          title: data[0]['snippet']['title'],
          id: data[0]['snippet']['resourceId']['videoId'],
          iframeSrc: $sce.trustAsResourceUrl('https://www.youtube.com/embed/' + data[0]['snippet']['resourceId']['videoId'])
        };
      }
    }

    function fbLink(id) {
      window.open('http://facebook.com/' + id, '_blank');
    }

    function fbThing() {
      /*155769061190996|tLG18YgyebO0xLmXmnx3JwwJmjY*/
      FB.api('/943915212383202/posts?limit=6&fields=id,message,object_id,picture', 'get', { 'access_token': '172690413241855|IKxrR7LKMN3DAPU1lECL8eW016U' }, function(resp) {
        for(var i=0; i<resp.data.length; i++) {
          var postItem = resp.data[i], postPush = {
            text: postItem['message'],
            id: postItem['id'],
            object_id: postItem['object_id']
          };


          if(!postItem['object_id']) {
            postPush['img'] = postItem['picture'];
          }

          vm.posts.push(postPush);

          if(postItem['object_id']) {
            FB.api('/' + postItem['object_id'] + '?fields=images', 'get', { 'access_token': '172690413241855|IKxrR7LKMN3DAPU1lECL8eW016U' }, function(resp) {
              for(var i=0; i<vm.posts.length; i++) {
                if(vm.posts[i]['object_id'] == resp['id']) {
                  vm.posts[i]['img'] = resp.images[0].source;
                }
              }
              $scope.$apply();
            });
          }
        }
        $scope.$apply();
      });
    }

    function showVideo(id) {
      vm.currentVideoSrc = $sce.trustAsResourceUrl('https://www.youtube.com/embed/' + id + '?autoplay=1');
      vm.feedExpanded = true;
    }

    function hideExpanded() {
      vm.miniPage = 0;
      vm.currentVideoSrc = null;
      vm.feedExpanded = false;
    }

    function changeFeed(feed) {
      if(feed === 'facebook') {
        vm.fbThing();
      }
      vm.feedExpanded = false;
      vm.mainPage = 0;
      vm.currentFeed = feed;
    }
    // END HOME PAGE


    // GEAR PAGE
    vm.guitarPage = 0;
    vm.pedalPage = 0;
    vm.guitars = [];
    vm.amps = [];
    vm.pedals = [];

    // END GEAR PAGE
  }
})();
