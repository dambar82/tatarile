const path = require("path");
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");

module.exports = {
    mode: "development",
    entry: {
        site: ["./web/css/site.scss"],
        site2018: ["./web/css/site2018.scss"],
        header: ["./web/css/header.scss"],
        footer: ["./web/css/footer.scss"]
    },
    output: {
        path: __dirname + "/web/css"
    },
    devtool: "source-map",
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({
                    fallback: "style-loader",
                    use: [
                        {
                            loader: "css-loader",
                            options: {
                                url: false,
                                sourceMap: true
                            }
                        },
                        {
                            loader: "postcss-loader",
                            options: {
                                plugins: [
                                    autoprefixer({
                                        browsers: ["ie >= 8", "last 4 version"]
                                    }),
                                    cssnano({
                                        preset: ["default", { discardComments: { removeAll: true } }]
                                    })
                                ],
                                sourceMap: true
                            }
                        },
                        {
                            loader: "sass-loader",
                            options: {
                                sourceMap: true
                            }
                        }
                    ]
                })
            }
        ]
    },
    plugins: [
        new ExtractTextPlugin({
            filename: "[name].css" // а тут надо прописать имя css которое вы хотите
        })
    ]
};
