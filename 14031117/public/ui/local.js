'use strict';
(() => {
  const state = JSON.parse(document.getElementById('ui-state').textContent);
  for (const id of ['modalOverlay','DCCForm']) { const overlay=document.getElementById(id); if(overlay)overlay.hidden=true; }
  function localUrl(path) { const u=new URL(path,location.origin); u.searchParams.set('mode',state.mode); return u.pathname+u.search; }
  for(const a of document.querySelectorAll('a[href]')) {
    const u=new URL(a.href);
    if(u.origin===location.origin && u.pathname.startsWith('/mehrabad/') && !a.classList.contains('ui-mode-link'))a.href=localUrl(a.href);
  }
  const toast = document.getElementById('ui-toast');
  let timer;
  function notice(message) { toast.textContent=message; toast.hidden=false; clearTimeout(timer); timer=setTimeout(()=>{toast.hidden=true;},6000); }
  function modal(title,message) { document.getElementById('dialog-title').textContent=title; document.getElementById('dialog-body').textContent=message; document.getElementById('ui-dialog').showModal(); }
  document.getElementById('dialog-close').addEventListener('click',()=>document.getElementById('ui-dialog').close());
  document.getElementById('ui-dialog').addEventListener('click',event=>{if(event.target.id==='ui-dialog')event.target.close();});
  document.getElementById('menu-toggle').addEventListener('click',event=>{const open=document.getElementById('ui-sidebar').classList.toggle('open');event.currentTarget.setAttribute('aria-expanded',String(open));});
  const tabs=[...document.querySelectorAll('[data-tabs-target]')];
  function activate(tab) { for(const item of tabs){const active=item===tab;item.setAttribute('aria-selected',String(active));const panel=document.querySelector(item.dataset.tabsTarget);if(panel){panel.hidden=!active;panel.classList.toggle('hidden',!active);}} }
  for(const tab of tabs)tab.addEventListener('click',()=>activate(tab));
  if(tabs.length)activate(tabs[0]);
  // Add discoverable labels to the original icon-only controls.
  for(const element of document.querySelectorAll('[data-tooltip-target]')){
    const tooltip=document.getElementById(element.dataset.tooltipTarget);
    if(tooltip){const label=tooltip.textContent.trim();element.setAttribute('title',label);if(!element.getAttribute('aria-label'))element.setAttribute('aria-label',label);}
  }
  for(const link of document.querySelectorAll('a[href*="/prjman/show/"]'))link.setAttribute('aria-label','نمایش شناسنامهٔ '+new URL(link.href).searchParams.get('p'));
  for(const table of document.querySelectorAll('main table')){
    if(table.closest('.container,.ui-table-scroll')||table.classList.contains('ui-simple-table'))continue;
    const scroll=document.createElement('div');scroll.className='ui-table-scroll';table.before(scroll);scroll.append(table);
  }
  if(state.route==='prjman'){
    const search=document.createElement('label');search.className='ui-search';search.append('جست‌وجوی پروژه‌ها');const input=document.createElement('input');input.type='search';input.placeholder='کد، نام پروژه یا کارفرما';input.setAttribute('aria-label','جست‌وجوی پروژه‌ها');search.append(input);
    document.getElementById('default-styled-tab').parentElement.before(search);
    const rows=[...document.querySelectorAll('[role=tabpanel] tbody tr')];
    const summary=document.createElement('span');summary.id='ui-search-summary';summary.setAttribute('role','status');input.setAttribute('aria-describedby',summary.id);search.append(summary);
    const clear=document.createElement('button');clear.type='button';clear.textContent='پاک کردن جست‌وجو';clear.className='ui-clear-search';search.append(clear);
    const storageKey='mehrabad-14031117-project-list:'+state.mode;
    function normalize(value){return value.toLocaleLowerCase('fa').replace(/[يى]/g,'ی').replace(/ك/g,'ک').replace(/[۰-۹]/g,d=>String('۰۱۲۳۴۵۶۷۸۹'.indexOf(d))).replace(/[٠-٩]/g,d=>String('٠١٢٣٤٥٦٧٨٩'.indexOf(d)));}
    function filter(){
      const query=normalize(input.value.trim());
      for(const row of rows)row.hidden=!normalize(row.textContent).includes(query);
      const active=tabs.find(tab=>tab.getAttribute('aria-selected')==='true');
      const panel=active?document.querySelector(active.dataset.tabsTarget):null;
      const count=panel?[...panel.querySelectorAll('tbody tr')].filter(row=>!row.hidden).length:0;
      summary.textContent=count.toLocaleString('fa-IR')+' پروژه';clear.disabled=input.value==='';
    }
    function remember(){
      const active=tabs.find(tab=>tab.getAttribute('aria-selected')==='true');
      const saved={mode:state.mode,query:input.value,tab:active?.id||tabs[0]?.id,scrollY:window.scrollY};
      try{sessionStorage.setItem(storageKey,JSON.stringify(saved));}catch{}
      // Each history entry keeps its own filter; typing does not add Back entries.
      const url=new URL(location.href);if(input.value)url.searchParams.set('q',input.value);else url.searchParams.delete('q');
      if(active&&active!==tabs[0])url.searchParams.set('tab',active.id);else url.searchParams.delete('tab');
      try{history.replaceState({...history.state,mehrabadProjectList:saved},'',url.pathname+url.search);}catch{}
    }
    function restoreList(){
      const entry=history.state?.mehrabadProjectList;
      let saved=entry?.mode===state.mode?entry:null;
      if(!saved){try{saved=JSON.parse(sessionStorage.getItem(storageKey));}catch{}}
      const url=new URL(location.href);
      input.value=url.searchParams.has('q')?url.searchParams.get('q'):(typeof saved?.query==='string'?saved.query:'');
      const tabId=url.searchParams.get('tab')||saved?.tab;
      activate(tabs.find(tab=>tab.id===tabId)||tabs[0]);filter();
      if(saved?.scrollY)requestAnimationFrame(()=>window.scrollTo(0,saved.scrollY));
    }
    input.addEventListener('input',()=>{filter();remember();});
    for(const tab of tabs)tab.addEventListener('click',()=>{filter();remember();});
    clear.addEventListener('click',()=>{input.value='';filter();remember();input.focus();});
    window.addEventListener('pagehide',remember);
    window.addEventListener('pageshow',()=>{restoreList();});
    restoreList();
  }
  const detail=['prjman/show','project/editp'].includes(state.route);
  const key='mehrabad-14031117-draft:'+state.mode+':'+state.code;
  const fields=()=>[...document.querySelectorAll('main textarea,main select,main input:not([type=hidden])')];
  function restore(){let saved;try{saved=JSON.parse(localStorage.getItem(key));}catch{return;}if(!Array.isArray(saved))return;fields().forEach((field,index)=>{const item=saved[index];if(!item||item.tag!==field.tagName||item.id!==field.id)return;if(field.type==='checkbox'||field.type==='radio')field.checked=Boolean(item.checked);else field.value=item.value;});}
  function save(){try{localStorage.setItem(key,JSON.stringify(fields().map(field=>({id:field.id,tag:field.tagName,value:field.value,checked:field.checked}))));notice('پیش‌نویس '+state.code+' فقط در همین مرورگر ذخیره شد؛ دیتابیس اصلی تغییری نکرد.');}catch{notice('ذخیرهٔ محلی در مرورگر در دسترس نیست.');}}
  if(detail){
    restore();
    const tools=document.createElement('div');tools.className='ui-local-tools';
    const saveButton=document.createElement('button');saveButton.type='button';saveButton.id='ui-save-draft';saveButton.textContent='ذخیرهٔ پیش‌نویس محلی';saveButton.addEventListener('click',save);tools.append(saveButton);
    const reset=document.createElement('button');reset.type='button';reset.className='secondary';reset.textContent='بازگردانی اطلاعات نمونه';reset.addEventListener('click',()=>{try{localStorage.removeItem(key);location.reload();}catch{notice('مرورگر اجازهٔ حذف پیش‌نویس را نداد.');}});tools.append(reset);
    const back=document.createElement('a');back.href=localUrl('/mehrabad/prjman');back.textContent='بازگشت به پروژه‌ها';tools.append(back);document.querySelector('.ui-content').prepend(tools);
    const reload=document.getElementById('reloadAllSheets');if(reload){reload.title='بازخوانی پیش‌نویس محلی';reload.setAttribute('aria-label',reload.title);}
    for(const icon of document.querySelectorAll('.ui-content>.no-print i,.ui-content>.no-print img')){icon.setAttribute('role','button');icon.tabIndex=0;}
  }
  document.addEventListener('submit',event=>{event.preventDefault();notice('ارسال به سرور در این نسخه فعال نیست.');},true);
  document.addEventListener('keydown',event=>{if(['Enter',' '].includes(event.key)&&event.target.matches('[role=button]:not(button)')){event.preventDefault();event.target.click();}});
  document.addEventListener('click',event=>{
    const saveIcon=event.target.closest('[id^=saveAllSheetsprj]');
    if(saveIcon){event.preventDefault();save();return;}
    if(event.target.closest('#reloadAllSheets')){event.preventDefault();location.reload();return;}
    if(event.target.closest('#ender_return')){location.assign(localUrl('/mehrabad/prjman'));return;}
    const link=event.target.closest('a[href]');
    if(link){const target=new URL(link.href);if(target.origin!==location.origin){event.preventDefault();notice('لینک بیرونی در نسخهٔ محلی باز نمی‌شود.');}return;}
    const actionElement=event.target.closest('[data-ui-onclick]')||event.target.closest('button')?.querySelector('[data-ui-onclick]');
    if(!actionElement){
      if(event.target.closest('[data-modal-target]')){event.preventDefault();modal('اطلاعات تکمیلی پروژه','این پنجره به اطلاعات دیتابیس اصلی وابسته است و در حالت نمایش محلی بارگذاری نمی‌شود.');}
      return;
    }
    event.preventDefault();
    const owner=actionElement.closest('button');if(owner?.disabled||actionElement.hasAttribute('disabled'))return;
    const action=actionElement.dataset.uiOnclick;
    const code=action.match(/P\d{6}/)?.[0]||state.code;
    if(action.includes('prjman/epl')){location.assign(localUrl('/mehrabad/prjman/epl/?p='+encodeURIComponent(code)));return;}
    if(action.includes('prjman/dpl')){location.assign(localUrl('/mehrabad/prjman/dpl/?p='+encodeURIComponent(code)));return;}
    if(action.includes('location.reload')){location.reload();return;}
    if(action.includes('openDCCForm'))modal('کنترل اسناد — '+code,'این مسیر به پروژهٔ '+code+' تعلق دارد. اسناد واقعی و گردش تأیید به دیتابیس اصلی نیاز دارند.');
    else if(action.includes('openDocContainer'))modal('پیوست‌های '+code,'پیوست واقعی برای داده‌های نمونه تعریف نشده است.');
    else if(action.includes('showProjectLOG'))modal('سوابق پروژهٔ '+code,'این پروژه نمونه است و سابقهٔ عملیات واقعی ندارد.');
    else modal('عملیات نسخهٔ اصلی','این عملیات به سرویس‌ها یا دیتابیس اصلی وابسته است و در نسخهٔ محلی اجرا نمی‌شود.');
  });
})();
