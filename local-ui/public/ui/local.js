'use strict';
(() => {
  const state = JSON.parse(document.getElementById('ui-state').textContent);
  for (const id of ['modalOverlay','DCCForm']) { const overlay=document.getElementById(id); if(overlay)overlay.hidden=true; }
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
    input.addEventListener('input',()=>{for(const row of rows)row.hidden=!row.textContent.toLocaleLowerCase('fa').includes(input.value.trim().toLocaleLowerCase('fa'));});
  }
  const detail=['prjman/show','project/editp'].includes(state.route);
  const key='mehrabad-ui-draft:'+state.code;
  const fields=()=>[...document.querySelectorAll('main textarea,main select,main input:not([type=hidden])')];
  function restore(){let saved;try{saved=JSON.parse(localStorage.getItem(key));}catch{return;}if(!Array.isArray(saved))return;fields().forEach((field,index)=>{const item=saved[index];if(!item||item.tag!==field.tagName||item.id!==field.id)return;if(field.type==='checkbox'||field.type==='radio')field.checked=Boolean(item.checked);else field.value=item.value;});}
  function save(){try{localStorage.setItem(key,JSON.stringify(fields().map(field=>({id:field.id,tag:field.tagName,value:field.value,checked:field.checked}))));notice('پیش‌نویس '+state.code+' فقط در همین مرورگر ذخیره شد؛ دیتابیس اصلی تغییری نکرد.');}catch{notice('ذخیرهٔ محلی در مرورگر در دسترس نیست.');}}
  if(detail){
    restore();
    const tools=document.createElement('div');tools.className='ui-local-tools';
    const saveButton=document.createElement('button');saveButton.type='button';saveButton.id='ui-save-draft';saveButton.textContent='ذخیرهٔ پیش‌نویس محلی';saveButton.addEventListener('click',save);tools.append(saveButton);
    const reset=document.createElement('button');reset.type='button';reset.className='secondary';reset.textContent='بازگردانی اطلاعات نمونه';reset.addEventListener('click',()=>{try{localStorage.removeItem(key);location.reload();}catch{notice('مرورگر اجازهٔ حذف پیش‌نویس را نداد.');}});tools.append(reset);
    const back=document.createElement('a');back.href='/mehrabad/prjman';back.textContent='بازگشت به پروژه‌ها';tools.append(back);document.querySelector('.ui-content').prepend(tools);
    const reload=document.getElementById('reloadAllSheets');if(reload){reload.title='بازخوانی پیش‌نویس محلی';reload.setAttribute('aria-label',reload.title);}
    for(const icon of document.querySelectorAll('.ui-content>.no-print i,.ui-content>.no-print img')){icon.setAttribute('role','button');icon.tabIndex=0;}
  }
  document.addEventListener('submit',event=>{event.preventDefault();notice('ارسال به سرور در این نسخه فعال نیست.');},true);
  document.addEventListener('keydown',event=>{if(['Enter',' '].includes(event.key)&&event.target.matches('[role=button]:not(button)')){event.preventDefault();event.target.click();}});
  document.addEventListener('click',event=>{
    const saveIcon=event.target.closest('[id^=saveAllSheetsprj]');
    if(saveIcon){event.preventDefault();save();return;}
    if(event.target.closest('#reloadAllSheets')){event.preventDefault();location.reload();return;}
    if(event.target.closest('#ender_return')){location.assign('/mehrabad/prjman');return;}
    const link=event.target.closest('a[href]');
    if(link){const target=new URL(link.href);if(target.origin!==location.origin){event.preventDefault();notice('لینک بیرونی در نسخهٔ محلی باز نمی‌شود.');}return;}
    const actionElement=event.target.closest('[data-ui-onclick]')||event.target.closest('button')?.querySelector('[data-ui-onclick]');
    if(!actionElement)return;
    event.preventDefault();
    const owner=actionElement.closest('button');if(owner?.disabled||actionElement.hasAttribute('disabled'))return;
    const action=actionElement.dataset.uiOnclick;
    const code=action.match(/P\d{6}/)?.[0]||state.code;
    if(action.includes('prjman/epl')){location.assign('/mehrabad/prjman/epl/?p='+encodeURIComponent(code));return;}
    if(action.includes('prjman/dpl')){location.assign('/mehrabad/prjman/dpl/?p='+encodeURIComponent(code));return;}
    if(action.includes('location.reload')){location.reload();return;}
    if(action.includes('openDCCForm'))modal('کنترل اسناد — '+code,'این مسیر به پروژهٔ '+code+' تعلق دارد. اسناد واقعی و گردش تأیید به دیتابیس اصلی نیاز دارند.');
    else if(action.includes('openDocContainer'))modal('پیوست‌های '+code,'پیوست واقعی برای داده‌های نمونه تعریف نشده است.');
    else if(action.includes('showProjectLOG'))modal('سوابق پروژهٔ '+code,'این پروژه نمونه است و سابقهٔ عملیات واقعی ندارد.');
    else modal('عملیات نسخهٔ اصلی','این عملیات به سرویس‌ها یا دیتابیس اصلی وابسته است و در نسخهٔ محلی اجرا نمی‌شود.');
  });
})();
