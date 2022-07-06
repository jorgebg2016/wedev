module.exports = {
    apps : [
        {
            name   : "Frontend",
            script: "./node_modules/@vue/cli-service/bin/vue-cli-service.js",
            args: "serve",
            instances : 1,
            mode: "fork",
            env: {
                PORT: 3000
            }
        }
    ]
  }