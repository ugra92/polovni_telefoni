module.exports = function() {
    var adapter = {
        getData: function(route, successFunction, ctx, async) {
            var adapterReturnData = [];
            $.ajax({
                error:error,
                url: route,
                method: "GET",
                xhrFields: { withCredentials:true },
                async:async,
                contentType: 'application/json',
                dataType: 'text json'
            }).then(function (data) {
                adapterReturnData = data;
                if(successFunction != null && ctx != null){
                    successFunction(ctx,data);
                }
                return data;
            });
            return adapterReturnData;
        },
        sendData: function (route, data, method, successFunction, ctx) {
            $.ajax({
                error:error,
                url: route,
                method: method,
                xhrFields: { withCredentials:true },
                async: true,
                contentType: 'application/json',
                data: JSON.stringify(data),
                dataType: 'text json'
            }).then(function (data) {
                if(successFunction != null && ctx != null){
                    successFunction(ctx,data);
                }
                return data;
            });
        }
    };

    return adapter;
};
