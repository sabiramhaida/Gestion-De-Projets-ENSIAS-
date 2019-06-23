// helper function for cross-browser request object
    function getRequest(url, success, error) {
        var req = false;
        try{
            // most browsers
            req = new XMLHttpRequest();
        } 
        catch (e){
            // IE
            try{
                req = new ActiveXObject("Msxml2.XMLHTTP");
            } 
            catch(e) {
                // try an older version
                try{
                    req = new ActiveXObject("Microsoft.XMLHTTP");
                } 
                catch(e) {
                    return false;
                }
            }
        }       
        if (!req) return false;
        if (typeof success != 'function') success = function () {};
        if (typeof error!= 'function') error = function () {};
        req.onreadystatechange = function(){
            if(req.readyState == 4) {
                return req.status === 200 ? 
                success(req.responseText) : error(req.status);
            }
        }
        req.open("POST", url, true);
        req.send(null);
        return req;
    }

//------------------------------------------------------------------------------------------------------------------------
function setUpdateAction(param) {
    document.frmUser.action = param;
    document.frmUser.submit();
}


function setDeleteAction(param) {
    if(confirm("Voulez vous confirmer cette suppression ?")) {
        document.frmUser.action = param;
        document.frmUser.submit();
    }
}

function setAddAction(param) {
    document.frmUser.action = param;
    document.frmUser.submit();
}
//--------------------------------------------------------------------------------------------------------------------------


function setReporeterAction(param){
    if(confirm("N'oubliez pas de mentionner la Raison de votre demande")){
    document.frmUser.action=param;
    document.frmUser.submit();}
    else{
        document.frmUser.action="Etudiant_rv.php";
        }
}

function errorBinoProj() {
    document.frmUser.action = "Admin_Affectation.php";
    document.frmUser.submit();
}