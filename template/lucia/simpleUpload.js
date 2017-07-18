function simpleUpload(ajax_url,DOM_file,options){
    var forceIframe=false;var files=null;var limit=0;var max_file_size=0;var allowed_exts=[];var allowed_types=[];var expect_type="auto";var hash_worker=null;var on_hash_complete=null;var request_file_name="file";var request_data={};var xhrFields={};var on_init_callback=function(total_uploads){};var on_start_callback=function(file){};var on_progress_callback=function(progress){};var on_success_callback=function(data){};var on_error_callback=function(error){};var on_cancel_callback=function(){};var on_complete_callback=function(status){};var on_finish_callback=function(){};var upload_contexts=[];var private_upload_data=[];var instance_context={files:upload_contexts};var queued_files=0;var hidden_form=null;var file_completed=function(upload_num,status){on_complete(upload_num,status);queued_files--;if(queued_files==0)on_finish();simpleUpload.activeUploads--;simpleUpload.uploadNext();};var on_init=function(total_uploads){return on_init_callback.call(instance_context,total_uploads);};var on_start=function(upload_num,file){if(getUploadState(upload_num)>0)return false;if(on_start_callback.call(upload_contexts[upload_num],file)===false){setUploadState(upload_num,4);return false;}if(getUploadState(upload_num)>0)return false;setUploadState(upload_num,1);};var on_progress=function(upload_num,progress){if(getUploadState(upload_num)==1)on_progress_callback.call(upload_contexts[upload_num],progress);};var on_success=function(upload_num,data){if(getUploadState(upload_num)==1){setUploadState(upload_num,2);on_success_callback.call(upload_contexts[upload_num],data);file_completed(upload_num,"success");}};var on_error=function(upload_num,error){if(getUploadState(upload_num)==1){setUploadState(upload_num,3);on_error_callback.call(upload_contexts[upload_num],error);file_completed(upload_num,"error");}};var on_cancel=function(upload_num){on_cancel_callback.call(upload_contexts[upload_num]);file_completed(upload_num,"cancel");};var on_complete=function(upload_num,status){on_complete_callback.call(upload_contexts[upload_num],status);};var on_finish=function(){on_finish_callback.call(instance_context);if(hidden_form!=null)hidden_form.remove();};function create(){if(typeof options=="object"&&options!==null){if(typeof options.forceIframe=="boolean"){forceIframe=options.forceIframe;}if(typeof options.init=="function"){on_init_callback=options.init;}if(typeof options.start=="function"){on_start_callback=options.start;}if(typeof options.progress=="function"){on_progress_callback=options.progress;}if(typeof options.success=="function"){on_success_callback=options.success;}if(typeof options.error=="function"){on_error_callback=options.error;}if(typeof options.cancel=="function"){on_cancel_callback=options.cancel;}if(typeof options.complete=="function"){on_complete_callback=options.complete;}if(typeof options.finish=="function"){on_finish_callback=options.finish;}if(typeof options.hashWorker=="string"&&options.hashWorker!=""){hash_worker=options.hashWorker;}if(typeof options.hashComplete=="function"){on_hash_complete=options.hashComplete;}if(typeof options.data=="object"&&options.data!==null){for(var x in options.data){request_data[x]=options.data[x];}}if(typeof options.limit=="number"&&isInt(options.limit)&&options.limit>0){limit=options.limit;}if(typeof options.maxFileSize=="number"&&isInt(options.maxFileSize)&&options.maxFileSize>0){max_file_size=options.maxFileSize;}if(typeof options.allowedExts=="object"&&options.allowedExts!==null){for(var x in options.allowedExts){allowed_exts.push(options.allowedExts[x]);}}if(typeof options.allowedTypes=="object"&&options.allowedTypes!==null){for(var x in options.allowedTypes){allowed_types.push(options.allowedTypes[x]);}}if(typeof options.expect=="string"&&options.expect!=""){var lower_expect=options.expect.toLowerCase();var valid_expect_types=["auto","json","xml","html","script","text"];for(var x in valid_expect_types){if(valid_expect_types[x]==lower_expect){expect_type=lower_expect;break;}}}if(typeof options.xhrFields=="object"&&options.xhrFields!==null){for(var x in options.xhrFields){xhrFields[x]=options.xhrFields[x];}}}if(typeof DOM_file=="object"&&DOM_file!==null&&DOM_file instanceof jQuery){if(DOM_file.length>0){DOM_file=DOM_file.get(0);}else{return false;}}if(!forceIframe&&window.File&&window.FileReader&&window.FileList&&window.Blob){if(typeof options=="object"&&options!==null&&typeof options.files=="object"&&options.files!==null){files=options.files;}else if(typeof DOM_file=="object"&&DOM_file!==null&&typeof DOM_file.files=="object"&&DOM_file.files!==null){files=DOM_file.files;}}if((typeof DOM_file!="object"||DOM_file===null)&&files==null){return false;}if(typeof options=="object"&&options!==null&&typeof options.name=="string"&&options.name!=""){request_file_name=options.name.replace(/\[\s*\]/g,'[0]');}else if(typeof DOM_file=="object"&&DOM_file!==null&&typeof DOM_file.name=="string"&&DOM_file.name!=""){request_file_name=DOM_file.name.replace(/\[\s*\]/g,'[0]');}var num_files=0;if(files!=null){if(files.length>0){if(files.length>1&&window.FormData&&$.ajaxSettings.xhr().upload){if(limit>0&&files.length>limit){num_files=limit;}else{num_files=files.length;}}else{num_files=1;}}}else{if(DOM_file.value!=""){num_files=1;}}if(num_files>0){if(typeof DOM_file=="object"&&DOM_file!==null){var $DOM_file=$(DOM_file);hidden_form=$('<form>').hide().attr("enctype","multipart/form-data").attr("method","post").appendTo('body');$DOM_file.after($DOM_file.clone(true).val("")).removeAttr("onchange").off().removeAttr("id").attr("name",request_file_name).appendTo(hidden_form);}for(var i=0;i<num_files;i++){(function(i){private_upload_data[i]={state:0,hashWorker:null,xhr:null,iframe:null};upload_contexts[i]={upload:{index:i,state:"init",file:(files!=null)?files[i]:{name:DOM_file.value.split(/(\\|\/)/g).pop()},cancel:function(){if(getUploadState(i)==0){setUploadState(i,4);}else if(getUploadState(i)==1){setUploadState(i,4);if(private_upload_data[i].hashWorker!=null){private_upload_data[i].hashWorker.terminate();private_upload_data[i].hashWorker=null;}if(private_upload_data[i].xhr!=null){private_upload_data[i].xhr.abort();private_upload_data[i].xhr=null;}if(private_upload_data[i].iframe!=null){$('iframe[name=simpleUpload_iframe_'+private_upload_data[i].iframe+']').attr("src","javascript:false;");simpleUpload.dequeueIframe(private_upload_data[i].iframe);private_upload_data[i].iframe=null;}on_cancel(i);}else{return false;}return true;}}};})(i);}var init_value=on_init(num_files);if(init_value!==false){var num_files_limit=num_files;if(typeof init_value=="number"&&isInt(init_value)&&init_value>=0&&init_value<num_files){num_files_limit=init_value;for(var z=num_files_limit;z<num_files;z++){setUploadState(z,4);}}var remaining_uploads=[];for(var j=0;j<num_files_limit;j++){if(on_start(j,upload_contexts[j].upload.file)!==false)remaining_uploads[remaining_uploads.length]=j;}if(remaining_uploads.length>0){queued_files=remaining_uploads.length;simpleUpload.queueUpload(remaining_uploads,function(upload_num){validateFile(upload_num);});simpleUpload.uploadNext();}else{on_finish();}}else{for(var z in upload_contexts){setUploadState(z,4);}on_finish();}}}function validateFile(upload_num){if(getUploadState(upload_num)!=1)return;var file=null;if(files!=null){if(files[upload_num]!=undefined&&files[upload_num]!=null){file=files[upload_num];}else{on_error(upload_num,{name:"InternalError",message:"There was an error uploading the file"});return;}}else{if(DOM_file.value==""){on_error(upload_num,{name:"InternalError",message:"There was an error uploading the file"});return;}}if(allowed_exts.length>0&&!validateFileExtension(allowed_exts,file)){on_error(upload_num,{name:"InvalidFileExtensionError",message:"That file format is not allowed"});return;}if(allowed_types.length>0&&!validateFileMimeType(allowed_types,file)){on_error(upload_num,{name:"InvalidFileTypeError",message:"That file format is not allowed"});return;}if(max_file_size>0&&!validateFileSize(max_file_size,file)){on_error(upload_num,{name:"MaxFileSizeError",message:"That file is too big"});return;}if(hash_worker!=null&&on_hash_complete!=null){hashFile(upload_num);}else{uploadFile(upload_num);}}function hashFile(upload_num){if(files!=null){if(files[upload_num]!=undefined&&files[upload_num]!=null){if(window.Worker){var file=files[upload_num];if(file.size!=undefined&&file.size!=null&&file.size!=""&&isInt(file.size)&&(file.slice||file.webkitSlice||file.mozSlice)){try{var worker=new Worker(hash_worker);worker.addEventListener('error',function(event){worker.terminate();private_upload_data[upload_num].hashWorker=null;uploadFile(upload_num);},false);worker.addEventListener('message',function(event){if(event.data.result){var hash=event.data.result;worker.terminate();private_upload_data[upload_num].hashWorker=null;checkHash(upload_num,hash);}},false);var buffer_size,block,reader,blob,handle_hash_block,handle_load_block;handle_load_block=function(event){worker.postMessage({'message':event.target.result,'block':block});};handle_hash_block=function(event){if(block.end!==file.size){block.start+=buffer_size;block.end+=buffer_size;if(block.end>file.size){block.end=file.size;}reader=new FileReader();reader.onload=handle_load_block;if(file.slice){blob=file.slice(block.start,block.end);}else if(file.webkitSlice){blob=file.webkitSlice(block.start,block.end);}else if(file.mozSlice){blob=file.mozSlice(block.start,block.end);}reader.readAsArrayBuffer(blob);}};buffer_size=64*16*1024;block={'file_size':file.size,'start':0};block.end=buffer_size>file.size?file.size:buffer_size;worker.addEventListener('message',handle_hash_block,false);reader=new FileReader();reader.onload=handle_load_block;if(file.slice){blob=file.slice(block.start,block.end);}else if(file.webkitSlice){blob=file.webkitSlice(block.start,block.end);}else if(file.mozSlice){blob=file.mozSlice(block.start,block.end);}reader.readAsArrayBuffer(blob);private_upload_data[upload_num].hashWorker=worker;return;}catch(e){}}}}}uploadFile(upload_num);}function checkHash(upload_num,hash){if(getUploadState(upload_num)!=1)return;var callback_received=false;var success_callback=function(data){if(getUploadState(upload_num)!=1)return false;if(callback_received)return false;callback_received=true;on_progress(upload_num,100);on_success(upload_num,data);return true;};var proceed_callback=function(){if(getUploadState(upload_num)!=1)return false;if(callback_received)return false;callback_received=true;uploadFile(upload_num);return true;};var error_callback=function(error){if(getUploadState(upload_num)!=1)return false;if(callback_received)return false;callback_received=true;on_error(upload_num,{name:"HashError",message:error});return true;};on_hash_complete.call(upload_contexts[upload_num],hash,{success:success_callback,proceed:proceed_callback,error:error_callback});}
    
    function uploadFile(upload_num){
        if(getUploadState(upload_num)!=1)return;
        if(files!=null){
            if(files[upload_num]!=undefined&&files[upload_num]!=null){
                if(window.FormData){
                    var ajax_xhr=$.ajaxSettings.xhr();
                    if(ajax_xhr.upload){
                        var file=files[upload_num];
                        var formData=new FormData();
                        objectToFormData(formData,request_data);
                        formData.append(request_file_name,file);
                        var ajax_settings={
                            url:ajax_url,
                            data:formData,
                            type:'post',
                            cache:false,
                            xhrFields:xhrFields,
                            beforeSend:function(jqXHR){
                                private_upload_data[upload_num].xhr=jqXHR;
                            },
                            xhr:function(){
                                ajax_xhr.upload.addEventListener('progress',function(e){if(e.lengthComputable){on_progress(upload_num,(e.loaded/e.total)*100);}},false);return ajax_xhr;
                            },
                            error:function(e1,e2,e3){
                                console.log(e1);
                                console.log(e2);
                                console.log(e3);
                                private_upload_data[upload_num].xhr=null;
                                on_error(upload_num,{
                                    name:"RequestError",
                                    message:"Could not get response from server"
                                });
                            },
                            success:function(data){
                                private_upload_data[upload_num].xhr=null;on_progress(upload_num,100);on_success(upload_num,data);
                            },
                            contentType:false,
                            processData:false
                        };
                        if(expect_type!="auto"){
                            ajax_settings.dataType=expect_type;
                        }
                        $.ajax(ajax_settings);
                        return;
                    }
                }
            }else{
                on_error(upload_num,{
                    name:"InternalError",message:"There was an error uploading the file"
                });
                return;
            }
        }
        if(typeof DOM_file=="object"&&DOM_file!==null){
            uploadFileFallback(upload_num);
        }else{
            on_error(upload_num,{
                name:"UnsupportedError",
                message:"Your browser does not support this upload method"
            });
        }
    }
    
    function uploadFileFallback(upload_num){if(upload_num==0){var iframe_id=simpleUpload.queueIframe({origin:getOrigin(ajax_url),expect:expect_type,complete:function(data){if(getUploadState(upload_num)!=1)return;private_upload_data[upload_num].iframe=null;simpleUpload.dequeueIframe(iframe_id);on_progress(upload_num,100);on_success(upload_num,data);},error:function(error){if(getUploadState(upload_num)!=1)return;private_upload_data[upload_num].iframe=null;simpleUpload.dequeueIframe(iframe_id);on_error(upload_num,{name:"RequestError",message:error});}});private_upload_data[upload_num].iframe=iframe_id;var upload_data=objectToInput(request_data);hidden_form.attr("action",ajax_url+((ajax_url.lastIndexOf("?")==-1)?"?":"&")+"_iframeUpload="+iframe_id+"&_="+(new Date()).getTime()).attr("target","simpleUpload_iframe_"+iframe_id).prepend(upload_data).submit();}else{on_error(upload_num,{name:"UnsupportedError",message:"Multiple file uploads not supported"});}}
    
    function objectToInput(obj,parent_node){if(parent_node===undefined||parent_node===null||parent_node===""){parent_node=null;}var html="";for(var key in obj){if(obj[key]===undefined||obj[key]===null){html+=$('<div>').append($('<input type="hidden">').attr("name",(parent_node==null)?key+"":parent_node+"["+key+"]").val("")).html();}else if(typeof obj[key]=="object"){html+=objectToInput(obj[key],(parent_node==null)?key+"":parent_node+"["+key+"]");}else if(typeof obj[key]=="boolean"){html+=$('<div>').append($('<input type="hidden">').attr("name",(parent_node==null)?key+"":parent_node+"["+key+"]").val((obj[key])?"true":"false")).html();}else if(typeof obj[key]=="number"){html+=$('<div>').append($('<input type="hidden">').attr("name",(parent_node==null)?key+"":parent_node+"["+key+"]").val(obj[key]+"")).html();}else if(typeof obj[key]=="string"){html+=$('<div>').append($('<input type="hidden">').attr("name",(parent_node==null)?key+"":parent_node+"["+key+"]").val(obj[key])).html();}}return html;}
    function objectToFormData(formData,obj,parent_node){if(parent_node===undefined||parent_node===null||parent_node===""){parent_node=null;}for(var key in obj){if(obj[key]===undefined||obj[key]===null){formData.append((parent_node==null)?key+"":parent_node+"["+key+"]","");}else if(typeof obj[key]=="object"){objectToFormData(formData,obj[key],(parent_node==null)?key+"":parent_node+"["+key+"]");}else if(typeof obj[key]=="boolean"){formData.append((parent_node==null)?key+"":parent_node+"["+key+"]",(obj[key])?"true":"false");}else if(typeof obj[key]=="number"){formData.append((parent_node==null)?key+"":parent_node+"["+key+"]",obj[key]+"");}else if(typeof obj[key]=="string"){formData.append((parent_node==null)?key+"":parent_node+"["+key+"]",obj[key]);}}}
    function getUploadState(upload_num){return private_upload_data[upload_num].state;}
    function setUploadState(upload_num,state){var textState="";if(state==0)textState="init";else if(state==1)textState="uploading";else if(state==2)textState="success";else if(state==3)textState="error";else if(state==4)textState="cancel";else
    return false;private_upload_data[upload_num].state=state;
    upload_contexts[upload_num].upload.state=textState;}
    function getFileExtension(filename){var filename_dot_pos=filename.lastIndexOf('.');return(filename_dot_pos!=-1)?filename.substr(filename_dot_pos+1):"";}function validateFileExtension(valid_exts,file){if(file!=undefined&&file!=null){var file_name=file.name;if(file_name!=undefined&&file_name!=null&&file_name!=""){var file_ext=getFileExtension(file_name).toLowerCase();if(file_ext!=""){var valid_ext=false;for(var i in valid_exts){if(valid_exts[i].toLowerCase()==file_ext){valid_ext=true;break;}}if(valid_ext){return true;}else{return false;}}else{return false;}}}if(typeof DOM_file=="object"&&DOM_file!==null){var DOM_file_name=DOM_file.value;if(DOM_file_name!=""){var file_ext=getFileExtension(DOM_file_name).toLowerCase();if(file_ext!=""){var valid_ext=false;for(var i in valid_exts){if(valid_exts[i].toLowerCase()==file_ext){valid_ext=true;break;}}if(valid_ext){return true;}}}}else{return true;}return false;}function validateFileMimeType(valid_mime_types,file){if(file!=undefined&&file!=null){var file_mime_type=file.type;if(file_mime_type!=undefined&&file_mime_type!=null&&file_mime_type!=""){file_mime_type=file_mime_type.toLowerCase();var valid_mime_type=false;for(var i in valid_mime_types){if(valid_mime_types[i].toLowerCase()==file_mime_type){valid_mime_type=true;break;}}if(valid_mime_type){return true;}else{return false;}}}return true;}function validateFileSize(max_size,file){if(file!=undefined&&file!=null){var file_size=file.size;if(file_size!=undefined&&file_size!=null&&file_size!=""&&isInt(file_size)){if(file_size<=max_size){return true;}else{return false;}}}return true;}function isInt(num){if(!isNaN(num)){if((parseInt(num)+"")==num){return true;}}return false;}function getOrigin(url){var a=document.createElement('a');a.href=url;var host=a.host;var protocol=a.protocol;if(host=="")host=window.location.host;if(protocol==""||protocol==":")protocol=window.location.protocol;return protocol.replace(/\:$/,'')+"://"+host;}
create();
}

simpleUpload.maxUploads=10;
simpleUpload.activeUploads=0;
simpleUpload.uploads=[];
simpleUpload.iframes={};
simpleUpload.iframeCount=0;

simpleUpload.queueUpload=function(remaining_uploads,upload_callback){simpleUpload.uploads[simpleUpload.uploads.length]={uploads:remaining_uploads,callback:upload_callback};};
simpleUpload.uploadNext=function(){if(simpleUpload.uploads.length>0&&simpleUpload.activeUploads<simpleUpload.maxUploads){var upload_instance=simpleUpload.uploads[0];var upload_callback=upload_instance.callback;var upload_num=upload_instance.uploads.splice(0,1)[0];if(upload_instance.uploads.length==0){simpleUpload.uploads.splice(0,1);}simpleUpload.activeUploads++;upload_callback(upload_num);simpleUpload.uploadNext();}};
simpleUpload.queueIframe=function(opts){var id=0;while(id==0||id in simpleUpload.iframes){id=Math.floor((Math.random()*999999999)+1);}simpleUpload.iframes[id]=opts;simpleUpload.iframeCount++;$('body').append('<iframe name="simpleUpload_iframe_'+id+'" style="display: none;"></iframe>');return id;};
simpleUpload.dequeueIframe=function(id){if(id in simpleUpload.iframes){$('iframe[name=simpleUpload_iframe_'+id+']').remove();delete simpleUpload.iframes[id];simpleUpload.iframeCount--;}};
simpleUpload.convertDataType=function(expected_type,declared_type,data){var type="auto";if(expected_type=="auto"){if(typeof declared_type=="string"&&declared_type!=""){var lower_type=declared_type.toLowerCase();var valid_types=["json","xml","html","script","text"];for(var x in valid_types){if(valid_types[x]==lower_type){type=lower_type;break;}}}}else{type=expected_type;}if(type=="auto"){if(typeof data=="undefined"){return"";}if(typeof data=="object"){return data;}return String(data);}else if(type=="json"){if(typeof data=="undefined"||data===null){return null;}if(typeof data=="object"){return data;}if(typeof data=="string"){try{return $.parseJSON(data);}catch(e){return false;}}return false;}else if(type=="xml"){if(typeof data=="undefined"||data===null){return null;}if(typeof data=="string"){try{return $.parseXML(data);}catch(e){return false;}}return false;}else if(type=="script"){if(typeof data=="undefined"){return"";}if(typeof data=="string"){try{$.globalEval(data);return data;}catch(e){return false;}}return false;}else{if(typeof data=="undefined"){return"";}return String(data);}};
simpleUpload.iframeCallback=function(data){if(typeof data=="object"&&data!==null){var id=data.id;if(id in simpleUpload.iframes){var converted_data=simpleUpload.convertDataType(simpleUpload.iframes[id].expect,data.type,data.data);if(converted_data!==false){simpleUpload.iframes[id].complete(converted_data);}else{simpleUpload.iframes[id].error("Could not get response from server");}}}};
simpleUpload.postMessageCallback=function(e){try{var key=e.message?"message":"data";var data=e[key];if(typeof data=="string"&&data!=""){data=$.parseJSON(data);if(typeof data=="object"&&data!==null){if(typeof data.namespace=="string"&&data.namespace=="simpleUpload"){var id=data.id;if(id in simpleUpload.iframes){if(e.origin===simpleUpload.iframes[id].origin){var converted_data=simpleUpload.convertDataType(simpleUpload.iframes[id].expect,data.type,data.data);if(converted_data!==false){simpleUpload.iframes[id].complete(converted_data);}else{simpleUpload.iframes[id].error("Could not get response from server");}}}}}}}catch(e){}};
if(window.addEventListener){window.addEventListener("message",simpleUpload.postMessageCallback,false);}else{ window.attachEvent("onmessage",simpleUpload.postMessageCallback);}
(function($){
    $.fn.simpleUpload=function(url,opts){
        if($(this).length==0){if(typeof opts=="object"&&opts!==null&&typeof opts.files=="object"&&opts.files!==null){new simpleUpload(url,null,opts);return this;}}return this.each(function(){new simpleUpload(url,this,opts);});
    };
    $.fn.simpleUpload.maxSimultaneousUploads=function(num){
        if(typeof num==="undefined"){
            return simpleUpload.maxUploads;
        }else if(typeof num==="number"&&num>0){
            simpleUpload.maxUploads=num;return this;
        }}
        ;
})(jQuery);
/*
;(function(root, factory){
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports !== "undefined") {
        factory(require('jquery'));
    } else { factory(root.jQuery); }
}(this, function($){
    $.blaAlex = 1;
    console.log('simpleUpload');
    $.fn.simpleUpload=function(url,opts){if($(this).length==0){if(typeof opts=="object"&&opts!==null&&typeof opts.files=="object"&&opts.files!==null){new simpleUpload(url,null,opts);return this;}}return this.each(function(){new simpleUpload(url,this,opts);});};
    $.fn.simpleUpload.maxSimultaneousUploads=function(num){if(typeof num==="undefined"){return simpleUpload.maxUploads;}else if(typeof num==="number"&&num>0){simpleUpload.maxUploads=num;return this;}};
}));

console.log($.blaAlex);
*/