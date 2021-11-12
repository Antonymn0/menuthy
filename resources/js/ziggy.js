const Ziggy = {
    url: "http://localhost",
    port: null,
    defaults: {},
    routes: {
        "passport.authorizations.authorize": {
            uri: "oauth/authorize",
            methods: ["GET", "HEAD"],
        },
        "passport.authorizations.approve": {
            uri: "oauth/authorize",
            methods: ["POST"],
        },
        "passport.authorizations.deny": {
            uri: "oauth/authorize",
            methods: ["DELETE"],
        },
        "passport.token": { uri: "oauth/token", methods: ["POST"] },
        "passport.tokens.index": {
            uri: "oauth/tokens",
            methods: ["GET", "HEAD"],
        },
        "passport.tokens.destroy": {
            uri: "oauth/tokens/{token_id}",
            methods: ["DELETE"],
        },
        "passport.token.refresh": {
            uri: "oauth/token/refresh",
            methods: ["POST"],
        },
        "passport.clients.index": {
            uri: "oauth/clients",
            methods: ["GET", "HEAD"],
        },
        "passport.clients.store": { uri: "oauth/clients", methods: ["POST"] },
        "passport.clients.update": {
            uri: "oauth/clients/{client_id}",
            methods: ["PUT"],
        },
        "passport.clients.destroy": {
            uri: "oauth/clients/{client_id}",
            methods: ["DELETE"],
        },
        "passport.scopes.index": {
            uri: "oauth/scopes",
            methods: ["GET", "HEAD"],
        },
        "passport.personal.tokens.index": {
            uri: "oauth/personal-access-tokens",
            methods: ["GET", "HEAD"],
        },
        "passport.personal.tokens.store": {
            uri: "oauth/personal-access-tokens",
            methods: ["POST"],
        },
        "passport.personal.tokens.destroy": {
            uri: "oauth/personal-access-tokens/{token_id}",
            methods: ["DELETE"],
        },
        "users.index": { uri: "v1/users", methods: ["GET", "HEAD"] },
        "users.store": { uri: "v1/users", methods: ["POST"] },
        "users.show": { uri: "v1/users/{user}", methods: ["GET", "HEAD"] },
        "users.update": { uri: "v1/users/{user}", methods: ["PUT", "PATCH"] },
        "users.destroy": { uri: "v1/users/{user}", methods: ["DELETE"] },
        "order.index": { uri: "v1/order", methods: ["GET", "HEAD"] },
        "order.store": { uri: "v1/order", methods: ["POST"] },
        "order.show": { uri: "v1/order/{order}", methods: ["GET", "HEAD"] },
        "order.update": { uri: "v1/order/{order}", methods: ["PUT", "PATCH"] },
        "order.destroy": { uri: "v1/order/{order}", methods: ["DELETE"] },
        "payment.index": { uri: "v1/payment", methods: ["GET", "HEAD"] },
        "payment.store": { uri: "v1/payment", methods: ["POST"] },
        "payment.show": {
            uri: "v1/payment/{payment}",
            methods: ["GET", "HEAD"],
        },
        "payment.update": {
            uri: "v1/payment/{payment}",
            methods: ["PUT", "PATCH"],
        },
        "payment.destroy": { uri: "v1/payment/{payment}", methods: ["DELETE"] },
        dashboard: { uri: "dashboard", methods: ["GET", "HEAD"] },
        register: { uri: "register", methods: ["GET", "HEAD"] },
        login: { uri: "login", methods: ["GET", "HEAD"] },
        "password.request": {
            uri: "forgot-password",
            methods: ["GET", "HEAD"],
        },
        "password.email": { uri: "forgot-password", methods: ["POST"] },
        "password.reset": {
            uri: "reset-password/{token}",
            methods: ["GET", "HEAD"],
        },
        "password.update": { uri: "reset-password", methods: ["POST"] },
        "verification.notice": {
            uri: "verify-email",
            methods: ["GET", "HEAD"],
        },
        "verification.verify": {
            uri: "verify-email/{id}/{hash}",
            methods: ["GET", "HEAD"],
        },
        "verification.send": {
            uri: "email/verification-notification",
            methods: ["POST"],
        },
        "password.confirm": {
            uri: "confirm-password",
            methods: ["GET", "HEAD"],
        },
        logout: { uri: "logout", methods: ["POST"] },
    },
};

if (typeof window !== "undefined" && typeof window.Ziggy !== "undefined") {
    for (let name in window.Ziggy.routes) {
        Ziggy.routes[name] = window.Ziggy.routes[name];
    }
}

export { Ziggy };
