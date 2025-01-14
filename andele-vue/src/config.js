let config;

if (process.env.NODE_ENV !== 'production' ) {
    config = {
        $api_url: "http://localhost:8000",
        timeoutDuration: 1000
    };
} else {
    config = {
        $api_url: "http://localhost:8080",
        timeoutDuration: 1000
    };
}

export { config }