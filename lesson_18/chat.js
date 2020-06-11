angular.module('tChat', ['ngCookies', 'ngFileUpload'])
    .config(function($interpolateProvider){
        $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    });

angular.module('tChat').controller('chatCtrl', ['$rootScope', '$scope', '$timeout', 'apiService', '$cookies', 'Upload',  chatCtrlFun]);

function chatCtrlFun($rootScope, $scope, $timeout, apiService, $cookies, Upload) {
    $scope.selectedGender = "UNKNOWN";
    $scope.uuid = '';
    $scope.viewMode = 'select';
    $scope.chatLog = [];
    $scope.isConnected = false;
    $scope.isSearching = false;
    $scope.inputMessage = '';
    $scope.activeTimer = 0;
    $scope.showTyping = false;
    $scope.onlineIndClass = "online-indicator-off";
    $scope.useLP = false;
    $scope.openPhotoIndex = 0;
    $scope.showTryMoreButton = false;

    $scope.age = typeof $cookies['age'] === 'undefined' || $cookies['age'] == 'NaN' ? 0 : parseInt($cookies['age']);

    $scope.errorMessage = "";

    $scope.lastTypingSent = 0;

    $scope.has_media = false;
    $scope.media = [];

    $scope.init = function () {
        $scope.reloadMedia();
    };

    $scope.reloadMedia = function () {

        if(!window.location.href.includes('vkapp')) {
            apiService.getMedia('ALL', 0).then(function (res) {
                if (res.data['has_media']) {
                    $scope.has_media = true;
                    $scope.media = res.data['media'];
                }
            });
        }
    };

    $scope.openPhoto = function(ind) {
        console.log(ind);
        $scope.openPhotoIndex = ind;
    };

    $scope.uploadFiles = function(file, errFiles) {
        $scope.f = file;
        $scope.errFile = errFiles && errFiles[0];
        if (file) {
            file.upload = Upload.upload({
                url: '/api/photo/' + $scope.uuid,
                data: {chat_photo: file}
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    file.result = response.data;


                    console.log(response);
                    if (response.status > 0) {
                        console.log("INNER!");
                        console.log(response.data);

                        if (typeof response.data === 'string') {
                            var json_response = JSON.parse(response.data);
                            if(json_response.response) {
                                $scope.addPhoto('РўРё РЅР°РґС–СЃР»Р°РІ С„РѕС‚Рѕ', json_response.photo.small, json_response.photo.big, json_response.photo.ratio, 'my-message');
                            }
                        } else {
                            if (response.data.response) {
                                $scope.addPhoto('РўРё РЅР°РґС–СЃР»Р°РІ С„РѕС‚Рѕ', response.data.photo.small, response.data.photo.big, response.data.photo.ratio, 'my-message');
                            }
                        }
                    }
                });
            }, function (response) {

            }, function (evt) {
                // mb display anywhere progress?
            });
        }
    };

    $scope.selectGender = function (gender) {

        if($scope.age > 0) {

            $scope.errorMessage = "";
            $scope.selectedGender = gender;
            $scope.viewMode = 'chat';
            $scope.chatLog = [];
            $scope.uuid = '';
            $scope.onlineIndClass = 'online-indicator-off';
            $scope.showTryMoreButton = false;

            apiService.subscribe(gender, $scope.age).then(function (res) {
                if (res.data['response']) {
                    $scope.isSearching = true;
                    $scope.uuid = res.data['uuid'];
                    $scope.useLP = res.data['use_lp'];
                    console.log('Subscribed, uuid: ' + res.data['uuid']);
                    $scope.addMessage('Р§Р°С‚', 'РЁСѓРєР°СЋ С‚РѕР±С– СЃРїС–РІСЂРѕР·РјРѕРІРЅРёРєР°, Р·Р°С‡РµРєР°Р№ С‚СЂРѕС…Рё...');
                    $scope.connect();
                } else {
                    if (res.data['error'] === 'too_many_requests') {
                        $scope.addMessage('Р§Р°С‚', 'РўРё С–РЅС–С†С–СЋРІР°РІ Р·Р°РЅР°РґС‚Рѕ Р±Р°РіР°С‚Рѕ СЃРїСЂРѕР± СЂРѕР·РїРѕС‡Р°С‚Рё С‡Р°С‚. РЎРїСЂРѕР±СѓР№ РїС–Р·РЅС–С€Рµ.', 'system-message', 'strong');
                    } else {
                        $scope.addMessage('Р§Р°С‚', 'РќРµ РІРґР°Р»РѕСЃСЊ С–РЅС–С†С–СЋРІР°С‚Рё С‡Р°С‚. РЎРїСЂРѕР±СѓР№С‚Рµ РїС–Р·РЅС–С€Рµ.');
                    }

                    if (res.data['response']['error']) {
                        console.error(res.data['response']['error']);
                    }
                }
            });

        } else {
            $scope.errorMessage = "Р’СЃРµ Р¶ С‚Р°РєРё Р±Р°Р¶Р°РЅРѕ РѕР±СЂР°С‚Рё РІС–Рє";
        }

    };

    $scope.selectAge = function (ageBit) {

        if (($scope.age & ageBit) > 0) {
            $scope.age -= ageBit;
        } else {
            $scope.age += ageBit;
        }

        $cookies['age'] = $scope.age;

    };

    $scope.checkAge = function (ageBit) {
        return ($scope.age & ageBit) > 0;
    };

    $scope.connect = function () {
        if ($scope.isSearching) {
            apiService.connect($scope.uuid).then(function (res) {
                if(!res.data['response']) {
                    $scope.addMessage('Р§Р°С‚', 'РҐР°Р»РµРїР° :СЃ РџРµСЂРµР·Р°РІР°РЅС‚Р°Р¶ СЃС‚РѕСЂС–РЅРєСѓ С– СЃРїСЂРѕР±СѓР№ Р·РЅРѕРІСѓ.');
                    $scope.addMessage('Р§Р°С‚', res.data['error']);
                    console.error(res.data['error']);
                } else if (res.data['is_connected'] === false) {
                    if($scope.isSearching) {
                        $scope.activeTimer = $timeout($scope.connect, 1000);
                    } else {
                        console.log('Searching canceled');
                    }
                } else if (res.data['is_connected'] === true) {
                    if($scope.isSearching) {
                        $scope.isConnected = true;
                        $scope.isSearching = false;
                        $scope.addMessage('Р§Р°С‚', 'Р—РЅР°Р№С€РѕРІ ^_^ РќСѓ, С…С‚Рѕ РїРµСЂС€РёР№ РЅР°РїРёС€Рµ? ;)');
                        $scope.onlineIndClass = 'online-indicator-on';
                        $scope.read();
                        console.warn("People in the chat are closer than they appear.");
                        $scope.playConnected();
                    } else {
                        apiService.disconnect($scope.uuid);
                        $scope.onlineIndClass = 'online-indicator-off';
                    }
                }
            }, function (data) {
                $scope.activeTimer = $timeout($scope.connect, 5000);
            });
        }
    };

    $scope.read = function() {
        if($scope.isConnected){
            apiService.read($scope.uuid, $scope.useLP).then(function (res) {
                if(!res.data['response']){
                    if(!res.data['chat_alive']){
                        $scope.isConnected = false;
                        $scope.addMessage('Р§Р°С‚', 'РЎРїС–РІСЂРѕР·РјРѕРІРЅРёРє Р·Р°РІРµСЂС€РёРІ Р±РµСЃС–РґСѓ');
                    } else {
                        $scope.addMessage('Р§Р°С‚', 'РџРѕРјРёР»РєР° Р·РІвЂ™СЏР·РєСѓ. Р РѕР·вЂ™С”РґРЅР°РЅРѕ :СЃ');

                        if(res.data['error']){
                            $scope.addMessage('[error]', res.data['error']);
                        }
                    }

                    $scope.showTryMoreButton = true;
                    $scope.onlineIndClass = 'online-indicator-off';
                } else {
                    if (res.data['messages'] && res.data['messages'].length > 0) {
                        angular.forEach(res.data['messages'], function(value) {
                            if(value['type'] == 'TEXT') {
                                $scope.addMessage('РЎРїС–РІСЂРѕР·РјРѕРІРЅРёРє', value['text'], 'opposite-message');
                            } else if(value['type'] == 'PHOTO') {
                                $scope.addPhoto('РЎРїС–РІСЂРѕР·РјРѕРІРЅРёРє РЅР°РґС–СЃР»Р°РІ С„РѕС‚Рѕ', value['photo']['small'], value['photo']['big'], value['photo']['ratio'], 'opposite-message');
                            }
                        });
                        $scope.showTyping = false;
                        $scope.playNewMsg();
                    } else {
                        $scope.showTyping = res.data['is_typing'];
                        //TODO gracefully handle it:
                        // hold last registered typing timestamp
                        // set timer for few second
                        // to hide 'is typing' if event
                        // is outdated for ~2 sec
                    }
                    $scope.activeTimer = $timeout($scope.read, $scope.useLP ? 0 : 2500);

                    if(res.data['status'] == 'online') {
                        $scope.onlineIndClass = 'online-indicator-on';
                    } else if(res.data['status'] == 'away') {
                        $scope.onlineIndClass = 'online-indicator-aw';
                    } else if(res.data['status'] == 'offline') {
                        $scope.onlineIndClass = 'online-indicator-off';
                    }
                }
            }, function (data) {
                $scope.activeTimer = $timeout($scope.read, 5000);
            });
        } else {
            console.log('disconnected');
        }
    };

    $scope.sendMessage = function() {
        var messageText = $scope.inputMessage;
        if($scope.isConnected && messageText.length > 0) {
            apiService.sendMessage($scope.uuid, messageText).then(function(res){
                if(res.data['response']){

                } else {
                    $scope.addMessage('Р§Р°С‚', 'РўСЂР°РїРёР»Р°СЃСЊ РїРѕРјРёР»РєР°, РЅРµ РЅР°РґС–СЃР»Р°РЅРѕ');
                }
            });
            $scope.addMessage('РўРё', messageText, 'my-message');
            $scope.inputMessage = '';
        }
    };

    $scope.disconnect = function (){

        if (!window.confirm("РЇРєС‰Рѕ Р·Р°РєСЂРёС‚Рё РґС–Р°Р»РѕРі, С–СЃС‚РѕСЂС–СЋ Р±СѓРґРµ РІС‚СЂР°С‡РµРЅРѕ.")) {
            return;
        }

        $scope.reloadMedia();

        if($scope.isConnected){
            apiService.disconnect($scope.uuid).then(function () {
                $scope.isConnected = false;
                $scope.uuid = '';
                $scope.inputMessage = '';
                $scope.viewMode = 'select';
                $scope.chatLog = [];
            });
        } else {
            $scope.isSearching = false;
            $scope.viewMode = 'select';
        }
        $timeout.cancel($scope.activeTimer);
    };

    $scope.toggleSound = function () {

    };

    $scope.tapTap = function () {
        if($scope.lastTypingSent < new Date().getTime() - 4000){
            $scope.lastTypingSent = new Date().getTime();

            apiService.sendTyping($scope.uuid).then(function (res) {
                $scope.lastTypingSent = new Date().getTime();
            });

        }
    };

    $scope.playNewMsg = function() {
        if($rootScope.soundEnabled || Visibility.hidden()){
            var audio = new Audio('/sounds/new_message.wav');
            audio.play();
        }
    };

    $scope.playConnected = function() {
        if($rootScope.soundEnabled || Visibility.hidden()){
            var audio = new Audio('/sounds/connected.wav');
            audio.play();
        }
    };

    $scope.addMessage = function(authorName, textContent, messageType, contentMessageType) {

        messageType = messageType || 'system-message';
        contentMessageType = contentMessageType || '';

        $scope.chatLog.push({who: authorName, text: textContent, type: 'text', className: messageType, contentClassName: contentMessageType});
        $timeout(function() {
            var scroll = document.getElementById("chat-wrapper");
            scroll.scrollTop = scroll.scrollHeight;
        }, 0, false);

        globalContext.title.setAddTitle("РќРѕРІРµ РїРѕРІС–РґРѕРјР»РµРЅРЅСЏ...");
    };

    $scope.addPhoto = function(authorName, small, big, ratio, messageType, contentMessageType) {

        messageType = messageType || 'system-message';
        contentMessageType = contentMessageType || '';

        $scope.chatLog.push({who: authorName, small: small, big: big, type: 'photo', ratio: ratio, className: messageType, contentClassName: contentMessageType});
        $timeout(function() {
            var scroll = document.getElementById("chat-wrapper");
            scroll.scrollTop = scroll.scrollHeight;
        }, 0, false);

        $timeout(function() {
            var scroll = document.getElementById("chat-wrapper");
            scroll.scrollTop = scroll.scrollHeight;
        }, 50, false);

        globalContext.title.setAddTitle("РќРѕРІРµ РїРѕРІС–РґРѕРјР»РµРЅРЅСЏ...");
    }
}

angular.module('tChat').service('apiService', ['$http', apiServiceFun]);

function apiServiceFun($http) {

    var apiPath = "/api";
    var lpPath = "/lp";

    return ({
        getMedia: getMedia,
        subscribe: subscribe,
        connect: connect,
        read: read,
        sendMessage: sendMessage,
        disconnect: disconnect,
        getOnline: getOnline,
        sendTyping: sendTyping
    });

    function getMedia(gender, age) {
        return $http.get(apiPath + '/get-media');
    }

    function subscribe(gender, age) {
        return $http.get(apiPath + '/subscribe/' + gender + '/' + age);
    }

    function connect(uuid) {
        return $http.get(apiPath + '/connect/' + uuid);
    }

    function read(uuid, useLP) {
        return $http.get((useLP ? lpPath : apiPath) + '/read/' + uuid);
    }

    function sendMessage(uuid, text) {
        return $http.post(apiPath + '/send/' + uuid,  {'text': text});
    }

    function disconnect(uuid) {
        return $http.get(apiPath + '/disconnect/' + uuid);
    }

    function getOnline(useLP) {
        return $http.get((useLP ? lpPath : apiPath) + '/online');
    }
    function sendTyping(uuid) {
        return $http.get(apiPath + '/set-typing/' + uuid);
    }
}

angular.module('tChat').directive('onEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs['onEnter']);
                });

                event.preventDefault();
            }
        });
    };
});

angular.module('tChat').directive('onTyping', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which !== 13) {
                scope.$apply(function (){
                    scope.$eval(attrs['onTyping']);
                });
            }
        });
    };
});



angular.module('tChat').controller('menuCtrl', ['$rootScope', '$scope', '$timeout', 'apiService', menuCtrlFun]);

function menuCtrlFun($rootScope, $scope, $timeout, apiService) {
    $scope.online = 0;
    $rootScope.soundEnabled = true;

    $rootScope.toggleSound = function () {
        $rootScope.soundEnabled = !$rootScope.soundEnabled;
    };

    $scope.updateOnlineCount = function () {
        apiService.getOnline(true).then(function(res){
            $scope.online = res.data['response'];
        });

        $timeout($scope.updateOnlineCount, 10000);
    };

    $scope.updateOnlineCount();
}