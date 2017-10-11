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

/**
 * ------------------------------------------------
 * Mardown Editor Create
 * ------------------------------------------------
 */
function editormdCreate(target) {
    if($('#' + target).length) {
      var editor = editormd(target, {
        // path              : "../lib/", // Autoload modules mode, codemirror, marked... dependents libs path
        width             : "100%",
        height            : 640,
        path              : '/assets/lib/editormd/lib/',
        lineNumbers       : true,
        tex               : true,
        tocm              : true,
        emoji             : true,
        taskList          : true,
        codeFold          : true,
        searchReplace     : true,
        htmlDecode        : "style,script,iframe",
        flowChart         : true,
        sequenceDiagram   : true,
      });
    }
}

/**
 * ------------------------------------------------
 * Markdown Render
 * ------------------------------------------------
 */
function markdown_render(source, target) {

    //     $.get("test.md", function(markdown) {
            
      //   testEditormdView = editormd.markdownToHTML("test-editormd-view", {
    //             markdown        : markdown ,//+ "\r\n" + $("#append-test").text(),
    //             //htmlDecode      : true,       // 开启 HTML 标签解析，为了安全性，默认不开启
    //             htmlDecode      : "style,script,iframe",  // you can filter tags decode
    //             //toc             : false,
    //             tocm            : true,    // Using [TOCM]
    //             //tocContainer    : "#custom-toc-container", // 自定义 ToC 容器层
    //             //gfm             : false,
    //             //tocDropdown     : true,
    //             // markdownSourceCode : true, // 是否保留 Markdown 源码，即是否删除保存源码的 Textarea 标签
    //             emoji           : true,
    //             taskList        : true,
    //             tex             : true,  // 默认不解析
    //             flowChart       : true,  // 默认不解析
    //             sequenceDiagram : true,  // 默认不解析
    //         });
            
    //         //console.log("返回一个 jQuery 实例 =>", testEditormdView);
            
    //         // 获取Markdown源码
    //         //console.log(testEditormdView.getMarkdown());
            
    //         //alert(testEditormdView.getMarkdown());
    //     });

    if($('#' + source).text().length) {
      var Render = editormd.markdownToHTML(target, {
        markdown        : $('#' + source).text(),
        // width             : "100%",
        // height            : 640,
        // path              : '/assets/lib/editormd/lib/',
        lineNumbers       : true,
        tex               : true,
        tocm              : true,
        emoji             : true,
        taskList          : true,
        codeFold          : true,
        searchReplace     : true,
        htmlDecode        : "style,script,iframe",
        flowChart         : true,
        sequenceDiagram   : true,
      });
    }
}
/**
 * ------------------------------------------------
 * Markdown-IT Render
 * ------------------------------------------------
 */
function markdownit_render(source, target) {
    if($('#' + source).text().length) {
        // browser without AMD, added to "window" on script load
        // Note, there is no dash in "markdownit".

        hljs.initHighlightingOnLoad();
        hljs.initLineNumbersOnLoad();
        var md = window.markdownit({
            html:         false,        // Enable HTML tags in source
            xhtmlOut:     false,        // Use '/' to close single tags (<br />).
                                      // This is only for full CommonMark compatibility.
            breaks:       false,        // Convert '\n' in paragraphs into <br>
            langPrefix:   'language-',  // CSS language prefix for fenced blocks. Can be
                                      // useful for external highlighters.
            linkify:      false,        // Autoconvert URL-like text to links

            // Enable some language-neutral replacement + quotes beautification
            typographer:  false,

            // Double + single quotes replacement pairs, when typographer enabled,
            // and smartquotes on. Could be either a String or an Array.
            //
            // For example, you can use '«»„“' for Russian, '„“‚‘' for German,
            // and ['«\xA0', '\xA0»', '‹\xA0', '\xA0›'] for French (including nbsp).
            quotes: '“”‘’',

            // Highlighter function. Should return escaped HTML,
            // or '' if the source string is not changed and should be escaped externaly.
            // If result starts with <pre... internal wrapper is skipped.
            highlight: function (str, lang) {
                if (lang && hljs.getLanguage(lang)) {
                  try {
                    return '<pre class="hljs '+lang+'"><code>' +
                           hljs.highlight(lang, str, true).value +
                           '</code></pre>';
                  } catch (__) {}
                }

                return hljs.lineNumbersBlock('<pre class="hljs"><code>' + md.utils.escapeHtml(str) + '</code></pre>');
            }
        });
        var result = md.render($('#' + source).text());

        $('#' + target).html(result);
    }
}
/**
 * ------------------------------------------------
 * Get Base64 data of file input
 * ------------------------------------------------
 */
function getFileBase64(file, success, error) {
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = success;
    reader.onerror = error;
    // reader.readAsText(file);
}