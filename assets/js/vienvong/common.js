/**
 * Create Cookie item
 * ------------------------------------------------
 *
 * @param string item name
 * @param object item value
 * @param datetime expire date
 */
function createCookie(name,value,days, path) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }

    document.cookie = name + "=" + value + expires + "; path=" + path;
}

/**
 * Read Cookie item
 * ------------------------------------------------
 *
 * @param string item name
 */
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

/**
 * Erese Cookie item
 * ------------------------------------------------
 *
 * @param string item name
 */
function eraseCookie(name) {
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

/**
 * Set Cookie item
 * ------------------------------------------------
 *
 * @param string item name
 */
function setCookie(name, value, days) {
    createCookie(name,value,days, '/');    
}
/**
 * AES KEY Init
 * ------------------------------------------------
 * 
 * @todo create aes key package (key + init_vector + keypack_rsa_encrypt)
 *
 * @return void
 */
function aesKeyInit() {
    // Create AES Key and AES Initilization Vector
    var key = CryptoJS.lib.WordArray.random(256 / 8).toString(); 
    var iv = CryptoJS.lib.WordArray.random(128 / 8).toString();
    // Init aeskey in this page
    return {
        key: key,
        iv: iv,
    };
};

/**
 * RSA Encrypt
 * ------------------------------------------------
 * 
 * @param string data
 * @param key RSA pulbic hexa key
 *
 * @return string
 */
function rsaEncrypt(data, key) {
    if(data.length > 245) {
        console.log('RSA data lenght limited');
        return false;
    }

    if(key) {
        // Encrypt with the public key...
        var encrypt = new JSEncrypt();
        encrypt.setPublicKey(key);
        var encrypted = encrypt.encrypt(data);

        return encrypted;
    }else {
        console.log('RSA Key not existed');
        return false;
    }
}
/**
 * RSA Encrypt Data
 * ------------------------------------------------
 *
 * @todo Encrypt data by rsakey storaged in rootScope
 *
 * @param data
 *
 * @return void
 */
function rsaEncryptData(data){
    // Create AES Key Package, using rsa encrypt
    var rsakey = readCookie('publickey');
    if(!rsakey) {
        console.log('RSA Key not existed!');
        // function rsaKeyInit();
        return false;
    }

    rsakey =  '-----BEGIN PUBLIC KEY-----' + decodeURIComponent(rsakey).split('-----')[2] + '-----END PUBLIC KEY-----';
    
    return rsaEncrypt(data, rsakey);
}
/**
 * AES Encrypt
 * ------------------------------------------------
 *
 * @param json/string data data needed encrypt
 *
 * @return base64 string
 */
function aesEncrypt(data, aeskey) {
  if(aeskey) {
    // create Hexa format for initialization vector
    var iv = CryptoJS.enc.Hex.parse(aeskey.iv);
    // create Hexa format for key to encrypt
    var key = CryptoJS.enc.Hex.parse(aeskey.key);
    // setup initializtion vector for AES Method
    var options = {iv: iv};
    // Encrypt data input
    var encrypted = CryptoJS.AES.encrypt(JSON.stringify(data), key, options); 
    // Get Base64 string of data encrypted
    var text64 = encrypted.ciphertext.toString(CryptoJS.enc.Base64);
    // Return string of json request data
    return text64;
  }else {
    console.log('AES Key not existed');
    return false;
  }  
}
/**
 * AES Decrypt Data
 * ------------------------------------------------
 *
 * @todo Decrypt Response data recived from server using AES Decrypt Method
 *
 * @param Base64 data base64 string of data encrypted
 *
 * @return JSON
 */
function aesDecrypt(data, aeskey) {
  if(aeskey) {
    // create Hexa format for initialization vector
    var iv = CryptoJS.enc.Hex.parse(aeskey.iv);
    // create Hexa format for key to encrypt
    var key = CryptoJS.enc.Hex.parse(aeskey.key);
    // setup initializtion vector for AES Medtho
    var options = {iv: iv};
    // Decrypt data response
    var decrypted = CryptoJS.AES.decrypt(data, key, options);
    // return string of data responsed
    return angular.fromJson(CryptoJS.enc.Utf8.stringify(decrypted));
  }else {
    conosle.log('AES Key not existed');
    return false;
  }
};