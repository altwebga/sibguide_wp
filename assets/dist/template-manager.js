!function(e){"function"==typeof define&&define.amd?define("templateManager",e):e()}(function(){"use strict";var s={template:"#ts-edit-base-template",props:{template:Object},data(){return{modifyId:!1,newId:this.template.id,updating:!1}},methods:{saveId(){this.updating=!0,jQuery.get(Voxel_Config.ajax_url,{action:"backend.update_base_template_id",template_key:this.template.key,new_template_id:this.newId,_wpnonce:this.$root.config.nonce}).always(e=>{this.updating=!1,e.success?(this.template.id=this.newId,this.template.editSettings=!1,this.modifyId=!1):Voxel_Backend.alert(e.message||Voxel_Config.l10n.ajaxError,"error")})}}},n={template:"#ts-edit-custom-template",props:{template:Object},data(){return{modifyId:!1,newId:this.template.id,updating:!1,newLabel:this.template.label}},methods:{saveId(){this.updating=!0,jQuery.get(Voxel_Config.ajax_url,{action:"backend.update_custom_template_details",unique_key:this.template.unique_key,new_template_id:this.newId,new_template_label:this.newLabel,group:this.template.group,_wpnonce:this.$root.config.nonce}).always(e=>{this.updating=!1,e.success?(this.template.id=this.newId,this.template.label=this.newLabel,this.template._editing=!1):Voxel_Backend.alert(e.message||Voxel_Config.l10n.ajaxError,"error")})}}},o={template:"#ts-create-custom-template",data(){return{label:"",group:this.group,updating:!1}},methods:{saveId(){this.updating=!0,this.group=this.$root.config.editTemplateType,jQuery.get(Voxel_Config.ajax_url,{action:"backend.create_custom_template",label:this.label,group:this.group,_wpnonce:this.$root.config.nonce}).always(e=>{this.updating=!1,e.success?(this.$root.config.custom_templates=e.templates,this.$root.config.editTemplate=!1,this.$root.config.editTemplateType=""):Voxel_Backend.alert(e.message||Voxel_Config.l10n.ajaxError,"error")})}}},l={template:'<span class="hide"></span>',props:{template:Object},data(){return{updating:!1}},mounted(){this.editRules()},methods:{saveRules(){this.updating=!0;var e=jQuery.param({action:"backend.update_custom_template_rules",unique_key:this.template.unique_key,group:this.template.group,_wpnonce:this.$root.config.nonce});jQuery.post(Voxel_Config.ajax_url+"&"+e,{visibility_rules:JSON.stringify(this.template.visibility_rules)}).always(e=>{this.updating=!1,e.success?this.template.editRules=!1:Voxel_Backend.alert(e.message||Voxel_Config.l10n.ajaxError,"error")})},editRules(){Voxel_Dynamic.editVisibility(this.template.visibility_rules,{groups:Voxel_Dynamic.getDefaultGroups(),onSave:e=>{this.template.visibility_rules=e,this.saveRules()},onDiscard:()=>this.template.editRules=!1})}}};jQuery(e=>{var t,a,i=document.getElementById("vx-template-manager");i&&(t=JSON.parse(i.dataset.config),a=t,(t=Vue.createApp({el:i,data(){return{config:a,tab:a.tab}},methods:{setTab(e){this.tab=e;var t=new URL(window.location);t.searchParams.set("tab",e),window.history.replaceState(null,null,t)},editLink(e){return this.config.editLink.replace("{id}",e)},previewLink(e){return this.config.previewLink.replace("{id}",e)},insertTemplate(e){this.config.editTemplate=!0,this.config.editTemplateType=e},delete_custom_template(e,t){confirm("Are you sure you want to delete this template?")&&jQuery.get(Voxel_Config.ajax_url,{action:"backend.delete_custom_template",unique_key:e.unique_key,group:t,_wpnonce:this.config.nonce}).always(e=>{e.success?this.config.custom_templates=e.templates:Voxel_Backend.alert(e.message||Voxel_Config.l10n.ajaxError,"error")})},create_base_template(t){t._creating||(t._creating=!0,jQuery.get(Voxel_Config.ajax_url,{action:"backend.create_base_template",template_key:t.key,_wpnonce:this.config.nonce}).always(e=>{t._creating=!1,e.success?t.id=e.template_id:Voxel_Backend.alert(e.message||Voxel_Config.l10n.ajaxError,"error")}))},delete_base_template(t){confirm("Are you sure you want to delete this template?")&&jQuery.get(Voxel_Config.ajax_url,{action:"backend.delete_base_template",template_key:t.key,_wpnonce:this.config.nonce}).always(e=>{e.success?t.id=null:Voxel_Backend.alert(e.message||Voxel_Config.l10n.ajaxError,"error")})},dragStart(){},dragEnd(t){t.target.classList.add("vx-inert"),jQuery.post(Voxel_Config.ajax_url+"&action=backend.update_custom_template_order",{custom_templates:JSON.stringify(this.config.custom_templates),_wpnonce:this.config.nonce}).always(e=>{t.target.classList.remove("vx-inert"),e.success||Voxel_Backend.alert(e.message||Voxel_Config.l10n.ajaxError,"error")})}}})).component("field-key",Voxel_Backend.components.Field_Key),t.component("draggable",vuedraggable),t.component("edit-base-template",s),t.component("edit-custom-template",n),t.component("edit-custom-template-rules",l),t.component("create-custom-template",o),t.mount(i))})});
