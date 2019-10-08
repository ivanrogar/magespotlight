define([
    'jquery'
], function ($) {
    'use strict';

    var popupOptions = {
        type: 'popup',
        responsive: true,
        innerScroll: false,
        title: 'Spotlight Search',
        buttons: [],
        clickableOverlay: true,
        modalClass: 'spotlightsearch-modal'
    };

    var request;

    var delay = (function () {
        "use strict";
        var timer = 0;
        return function(callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();

    var searchInProgress = false;

    var parentElement = $('.spotlightsearch');

    var inputElement = $('.spotlightsearch--input');

    var resultsElement = $('.spotlightsearch--results');

    var resultsDataElement = $('.spotlightsearch--results-data');

    var searchUrl = inputElement.data('url');

    document.addEventListener ("keydown", function (e) {
        if (e.altKey && e.which === 83) {
            $(parentElement).modal(popupOptions).modal('openModal');

            setTimeout(function() {
                $(inputElement).focus();
                $(resultsElement).show();
            }, 500);

            e.preventDefault();
        }
    } );

    $("body").click(function(e) {
        if ($(e.target).parents('.spotlightsearch').length) {
            $(resultsElement).show();
        } else {
            $(resultsElement).hide();
        }
    });

    $(inputElement).keyup(function () {
        var value = $(this).val();

        if (value.length > 2) {
            delay(function() {
                if (!searchInProgress) {
                    performSearch(value);
                }
            }, 400);
        } else {
            clearResults();
        }
    });

    function performSearch(text) {
        searchInProgress = true;

        request = $.get(searchUrl, { search: text })
            .done(function(data) {
                $(resultsDataElement).html(data);
            })
            .fail(function( jqxhr, textStatus, error ) {
                var err = textStatus + ", " + error;
                console.log( "Request Failed: " + err );
                clearResults();
            })
            .always(function () {
                searchInProgress = false;
            });
    }

    function clearResults() {
        try {
            if (request) {
                request.abort();
            }
        } catch (e) {}

        $(resultsDataElement).html('No results');
    }
});
