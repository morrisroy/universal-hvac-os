async function loadAlerts() {
  const activeContainer = document.getElementById("active-alerts");
  const resolvedContainer = document.getElementById("resolved-alerts");
  activeContainer.innerHTML = "";
  resolvedContainer.innerHTML = "";

  try {
    const activeRes = await fetch("alerts.json?" + Date.now());
    const activeAlerts = await activeRes.json();

    const resolvedRes = await fetch("resolved.json?" + Date.now());
    const resolvedAlerts = await resolvedRes.json();

    // Render active alerts
    activeAlerts.forEach(alert => {
      const div = document.createElement("div");
      div.classList.add("alert");
      div.classList.add(getSeverity(alert.message));
      div.innerHTML = `
        <span><strong>${alert.unit}</strong>: ${alert.message} <br/><small>${alert.timestamp}</small></span>
        <button onclick="resolveAlert(${alert.id})">Resolve</button>
      `;
      activeContainer.appendChild(div);
    });

    // Render resolved alerts
    resolvedAlerts.forEach(alert => {
      const div = document.createElement("div");
      div.classList.add("alert", getSeverity(alert.message));
      div.innerHTML = `
        <span><strong>${alert.unit}</strong>: ${alert.message} <br/><small>Resolved: ${alert.resolved}</small></span>
      `;
      resolvedContainer.appendChild(div);
    });
  } catch (err) {
    console.error("Error loading alerts:", err);
  }
}

function getSeverity(message) {
  message = message.toLowerCase();
  if (message.includes("fault") || message.includes("shutdown") || message.includes("error") || message.includes("fail")) {
    return "error";
  } else if (message.includes("filter") || message.includes("maintenance") || message.includes("low") || message.includes("high") || message.includes("check")) {
    return "warning";
  }
  return "info";
}

async function resolveAlert(id) {
  // Check if backend (PHP) is available
  try {
    await fetch("resolve_alert.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "id=" + encodeURIComponent(id)
    });
  } catch (err) {
    console.log("Simulating resolve (GitHub Pages mode)");
  }
  loadAlerts();
}

// Refresh alerts every 10 seconds
setInterval(loadAlerts, 10000);
window.onload = loadAlerts;
