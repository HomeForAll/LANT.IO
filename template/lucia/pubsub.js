
var events = (function(){
  var topics = {};

  return {
    subscribe: function(topic, listener) {
      // создаем объект topic, если еще не создан
      if(!topics[topic]) topics[topic] = { queue: [] };

      // добавляем listener в очередь
      var index = topics[topic].queue.push(listener) -1;

	// предоставляем возможность удаления темы
	return {
		remove: function() {
			delete topics[topic].queue[index];
		}
	};
    },
    publish: function(topic, info) {
      // если темы не существует или нет подписчиков, не делаем ничего
      if(!topics[topic] || !topics[topic].queue.length) return;

      // проходим по очереди и вызываем подписки
      var items = topics[topic].queue;
      items.forEach(function(item) {
      		item(info || {});
      });
    }
  };
})();


// events.publish('/page/load', {
// 	url: '/some/url/path' // любой аргумент
// });

// var subscription = events.subscribe('/page/load', function(obj) {
// 	// делаем что-нибудь, когда событие происходит
// });

// ...теперь мне эта подписка больше не нужна...
// subscription.remove();