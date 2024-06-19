from flask import Flask, request, jsonify, make_response
from openai import OpenAI
import json

import logging
logging.basicConfig(level=logging.INFO)

app = Flask(__name__)
port = 3000

@app.route('/')
def index():
    return 'Hello World!'

@app.route('/chat', methods=['POST'])
def chat():
    client = OpenAI()
    data = request.form
    message = data['message']
    thread_id = data['thread_id']

    # debug
    # message = 'こんにちは、gpt よろしくね'
    # thread_id = ''

    # スレッドの作成
    if not thread_id:
        thread = client.beta.threads.create()
        thread_id = thread.id

    # メッセージの作成
    new_message = client.beta.threads.messages.create(
        thread_id=thread_id,
        role="user",
        content=message
    )

    # アシスタントの実行
    run = client.beta.threads.runs.create_and_poll(
        thread_id=thread_id,
        assistant_id="asst_HCwnSdMvqno8SX13Ya3Fjdjk"
    )

    # 結果の取得
    if run.status == 'completed':
        messages = client.beta.threads.messages.list(thread_id=run.thread_id)
        message_content = messages.data[0].content
        response_data = message_content[0].text.value

        if isinstance(response_data, dict):
            if 'value' in response_data:
                response_data = response_data['value']
        else:
            response_data = json.loads(response_data)
        
        # response_dataのログ出力
        logging.info(f'Response Data: {response_data}')

        response_data['thread_id'] = run.thread_id
        
        # return jsonify(response_data)
    
        response = make_response(
            json.dumps(response_data, ensure_ascii=False),  # JSON_UNESCAPED_UNICODEオプションを指定
            200
        )
        response.headers['Content-Type'] = 'application/json; charset=utf-8'
        return response
    else:
        return jsonify({'status': run.status}), 400

if __name__ == '__main__':
    app.run(port=port)