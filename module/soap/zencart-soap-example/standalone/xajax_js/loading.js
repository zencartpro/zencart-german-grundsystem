xajax.callback.global.onRequest = function()
{
    xajax.$('loadingMessage').style.display='block';
};

function hideLoadingMessage()
{
    xajax.$('loadingMessage').style.display = 'none';
}
xajax.callback.global.onComplete = hideLoadingMessage;

