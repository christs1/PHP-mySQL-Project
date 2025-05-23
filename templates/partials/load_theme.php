<!-- DOC: script to save and load page settings -->
<script>
    'use strict';

    var htmlRoot = document.getElementsByTagName('HTML')[0],
        classHolder = document.getElementsByTagName('BODY')[0],
        head = document.getElementsByTagName('HEAD')[0],
        themeID = document.getElementById('mytheme'),
        filterClass = function (t, e) {
            return String(t).split(/[^\w-]+/).filter(function (t) {
                return e.test(t)
            }).join(' ')
        },
        /** 
         * Load theme options
         **/
        loadSettings = function () {
            var t = localStorage.getItem('themeSettings') || '',
                e = t ? JSON.parse(t) :
                    {};
            return Object.assign(
                {
                    htmlRoot: '',
                    classHolder: '',
                    themeURL: ''
                }, e)
        },
        /** 
         * Save to localstorage 
         **/
        saveSettings = function () {
            themeSettings.htmlRoot = filterClass(htmlRoot.className, /^(root)-/i),
                themeSettings.classHolder = filterClass(classHolder.className, /^(nav|header|footer|mod|display)-/i),
                themeSettings.themeURL = themeID.getAttribute("href") ? themeID.getAttribute("href") : "",
                localStorage.setItem("themeSettings", JSON.stringify(themeSettings))
        },
        /** 
         * Reset settings
         **/
        resetSettings = function () {
            localStorage.setItem("themeSettings", "")
        },
        themeSettings = loadSettings();

    themeID || ((themeID = document.createElement('link')).id = 'mytheme',
        themeID.rel = 'stylesheet',
        themeID.href = '',
        head.appendChild(themeID),
        themeID = document.getElementById('mytheme')),
        themeSettings.htmlRoot && (htmlRoot.className = themeSettings.htmlRoot),
        themeSettings.classHolder && (classHolder.className = themeSettings.classHolder),
        themeSettings.themeURL && themeID.setAttribute("href", themeSettings.themeURL);

</script>