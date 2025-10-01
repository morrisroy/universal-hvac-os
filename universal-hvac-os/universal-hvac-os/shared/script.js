
// shared script: small helpers & websocket placeholder
function wsConnect(){
  // placeholder for real websocket connection to backend
  if(window.location.hostname === 'localhost' || window.location.hostname.endsWith('githubpreview.dev') || window.location.hostname.endsWith('github.io')) {
    console.log('WS: running in demo mode — no backend websocket configured.');
    return;
  }
  try {
    const ws = new WebSocket('wss://' + window.location.host + '/ws');
    ws.onopen = ()=> console.log('WS connected');
    ws.onmessage = (ev)=> console.log('WS msg', ev.data);
  } catch(e){
    console.warn('WS unavailable', e);
  }
}
wsConnect();
