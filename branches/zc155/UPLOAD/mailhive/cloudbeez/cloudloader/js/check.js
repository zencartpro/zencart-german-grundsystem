/*
 MailBeez Automatic Trigger Email Campaigns
 http://www.mailbeez.com

 Copyright (c) 2010 - 2014 MailBeez

 inspired and in parts based on
 Copyright (c) 2003 osCommerce

 Released under the GNU General Public License (Version 2)
 [http://www.gnu.org/licenses/gpl-2.0.html]

 */


/*!
 * System Check Page (Step 1)
 */

Installer.Pages.systemCheck.init = function () {
    var checkList = $('#systemCheckList'),
        appEula = $('#appEula').hide(),
        systemCheckFailed = $('#systemCheckFailed').hide(),
        nextButton = $('#nextButton').addClass('disabled'),
        eventChain = []

    /*
     * Loops each requirement, posts it back and processes the result
     * as part of a waterfall
     */
    $.each(this.requirements, function (index, requirement) {
        eventChain.push(function () {
            var deferred = $.Deferred();

            var item = $('<li />').addClass('animated-content move_right').html(requirement.label)
            item.addClass('load animate fade_in')
            checkList.append(item)

            $.sendRequest('onCheckRequirement', {code: requirement.code}, {loadingIndicator: false})
                .done(function (data) {
                    // in case content type of response is text/html
                    if (typeof data != 'object') {
                        data = $.parseJSON(data);
                    }
                    setTimeout(function () {
                        if (data.result) {
                            item.removeClass('load').addClass('pass')
                            deferred.resolve()
                        }
                        else {
                            item.removeClass('load').addClass('fail')
                            deferred.reject(requirement.code)
                        }
                    }, 500)
                }).fail(function (data) {
                    item.removeClass('load').addClass('fail')
                    if (data.responseText) console.log('Failure reason: ' + data.responseText)
                    deferred.reject('ajaxFailure')
                })

            return deferred;
        })
    })

    /*
     * Handle the waterfall result
     */
    $.waterfall.apply(this, eventChain).fail(function (reason) {
        // Failed
        systemCheckFailed.show().addClass('animate fade_in')
        systemCheckFailed.renderPartial('check/fail', {reason: reason})
    }).done(function () {
        // Success
        appEula.show().addClass('animate fade_in')
        nextButton.removeClass('disabled')
    })
}

Installer.Pages.systemCheck.next = function () {
    Installer.showPage('installProgress')
}

Installer.Pages.systemCheck.retry = function () {
    var self = Installer.Pages.systemCheck
    $('#containerBody').html('').renderPartial('check', self)
    self.init()
}